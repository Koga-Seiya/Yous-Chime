// map.js
document.addEventListener('DOMContentLoaded', function () {
    // ドロップ領域やボタン、テーブルなどの要素を取得
    const dropZone = document.getElementById('dropZone');
    const toggleButton = document.getElementById('toggleDropZoneButton');
    const setPointButton = document.getElementById('setPointButton');
    const imageContainer = document.getElementById('imageContainer');
    const pointsTableBody = document.getElementById('pointsTableBody');
    const qrCodeContainer = document.getElementById('qrcode-container');

    // ポイントデータを取得または初期化
    let points = JSON.parse(localStorage.getItem('points')) || [];

    // ページ読み込み時に画像データとポイントデータを表示
    window.onload = function () {
        const storedImageData = localStorage.getItem('uploadedImageData');
        if (storedImageData) {
            imageContainer.innerHTML = `<img src="${storedImageData}" style="max-width: 100%; max-height: 100%;">`;
        }

        displayPoints();
    };

    // ドロップ領域の表示/非表示を切り替える処理
    dropZone.style.display = 'none';
    toggleButton.addEventListener('click', () => {
        if (dropZone.style.display === 'none') {
            dropZone.style.display = 'block';
        } else {
            dropZone.style.display = 'none';
        }
    });

    // 以下のコードはドラッグ＆ドロップの処理
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.border = '2px dashed #777';
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.style.border = '2px dashed #ccc';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.border = '2px dashed #ccc';

        const file = e.dataTransfer.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageDataURL = e.target.result;
                imageContainer.innerHTML = `<img src="${imageDataURL}" style="max-width: 100%; max-height: 100%;">`;

                localStorage.setItem('uploadedImageData', imageDataURL);
            };
            reader.readAsDataURL(file);
        } else {
            alert('画像ファイルを選択してください。');
        }
    });

    // ポイントを作成する関数
    function createPoint(x, y, value) {
        const point = document.createElement('div');
        point.className = 'point';
        point.style.left = x + 'px';
        point.style.top = y + 'px';
        point.setAttribute('data-value', value);
        return point;
    }

    // QRコードを生成して表示する関数
    function displayQRCode(value, container) {
        const qrcode = new QRCode(container, {
            text: value,
            width: 128,
            height: 128
        });

        const callPhpURL = 'call.php?pointValue=' + encodeURIComponent(value);

        qrcode._el.addEventListener('click', () => {
            window.location.href = callPhpURL;
        });
    }

    // ポイント情報を表示する処理
    function displayPointInfo(point, rowIndex) {
        const pointInfo = document.createElement('div');
        pointInfo.className = 'pointInfo';
        pointInfo.style.left = (parseInt(point.style.left) + 15) + 'px';
        pointInfo.style.top = point.style.top;
        pointInfo.textContent = `${point.getAttribute('data-value')}`;
        imageContainer.appendChild(pointInfo);

        // QRコードを表示するコンテナを作成
        const qrCodeContainer = document.createElement('td');
        qrCodeContainer.className = 'qrcode-container';
        qrCodeContainer.style.textAlign = 'center';
        qrCodeContainer.style.verticalAlign = 'middle';

        // QRコードを表示
        displayQRCode(point.getAttribute('data-value'), qrCodeContainer);

        // 削除ボタン
        const deleteButton = document.createElement('button');
        deleteButton.textContent = '削除';
        deleteButton.addEventListener('click', () => {
            // ボタンがクリックされたらポイントを削除
            points.splice(rowIndex, 1);
            // ポイントとポイント情報とQRコードを非表示にする
            point.remove();
            pointInfo.remove();
            const parentRow = qrCodeContainer.closest('tr');
            parentRow.remove();
            // ポイントデータを Local Storage に保存
            localStorage.setItem('points', JSON.stringify(points));
            // テーブルを再描画
            displayPoints();
        });

        const cell2 = document.createElement('td');
        cell2.appendChild(qrCodeContainer);

        const cell3 = document.createElement('td');
        cell3.appendChild(deleteButton);

        return [pointInfo, cell2, cell3];
    }

    // ポイントリストを表示する処理
    function displayPoints() {
        pointsTableBody.innerHTML = ''; // テーブルの中身をクリア

        points.forEach((point, index) => {
            const { x, y, value } = point;
            const createdPoint = createPoint(x, y, value);
            imageContainer.appendChild(createdPoint);

            const [pointInfo, qrCodeCell, deleteButtonCell] = displayPointInfo(createdPoint, index);

            // テーブルにポイント情報を追加
            const row = pointsTableBody.insertRow(index);
            const cell1 = row.insertCell(0);
            cell1.textContent = value;

            row.appendChild(qrCodeCell);
            row.appendChild(deleteButtonCell);
        });
    }

    // 「ポイント設定」ボタンが押されたときの処理
    setPointButton.addEventListener('click', () => {
        // メッセージを表示
        const message = prompt('場所を指定してください（クリックでポイントを設定）');

        // クリック時の処理を行う関数
        function handleClick(event) {
            const x = event.clientX - imageContainer.getBoundingClientRect().left;
            const y = event.clientY - imageContainer.getBoundingClientRect().top;

            const value = prompt('ポイントの値を入力してください:');

            const point = { x, y, value };

            points.push(point);

            displayPoints();

            imageContainer.removeEventListener('click', handleClick);

            alert(`ポイントが設定されました。設定した値: ${value}, 座標: (${x}, ${y})`);

            localStorage.setItem('points', JSON.stringify(points));
        }

        // クリック時の処理を設定
        imageContainer.addEventListener('click', handleClick);
    });
});
