// map2.js
document.addEventListener('DOMContentLoaded', function() {
    // ここに map2.js のコードを追加
    const dropZone = document.getElementById('dropZone');
        const toggleButton = document.getElementById('toggleDropZoneButton');
        const setPointButton = document.getElementById('setPointButton');
        const imageContainer = document.getElementById('imageContainer');
        const pointsTableBody = document.getElementById('pointsTableBody');
        let points = JSON.parse(localStorage.getItem('points')) || [];

        // ページ読み込み時に Local Storage から画像データとポイントデータを取得
        window.onload = function () {
            const storedImageData = localStorage.getItem('uploadedImageData');
            if (storedImageData) {
                imageContainer.innerHTML = `<img src="${storedImageData}" style="max-width: 100%; max-height: 100%;">`;
            }

            displayPoints();
        };

        // ボタンを押して表示/非表示を切り替える処理
        toggleButton.addEventListener('click', () => {
            if (dropZone.style.display === 'none') {
                // ドロップ領域を表示
                dropZone.style.display = 'block';
            } else {
                // ドロップ領域を非表示
                dropZone.style.display = 'none';
            }
        });

        // 以下のコードは既存のドラッグ＆ドロップの処理と同じ
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

                    // 画像データを Local Storage に保存
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


// QRコードを生成する関数
function generateQRCode(value) {
    console.log(value);
    const qrcode = new QRCode(document.getElementById("qrcode"), {
        text: value,
        width: 128,
        height: 128
    });

    // 「call.php」のURLを使用してQRコードを生成
    const callPhpURL = 'call.php?pointValue=' + encodeURIComponent(value);
    
    // QRコードがクリックされたときに「call.php」ページを開くためのイベントリスナーを追加
    qrcode._el.addEventListener('click', () => {
        window.location.href = callPhpURL;
    });

    return qrcode.toDataURL();
}


    // ポイント情報を表示する処理
    function displayPointInfo(point, rowIndex) {
        const pointInfo = document.createElement('div');
        pointInfo.className = 'pointInfo';
        pointInfo.style.left = (parseInt(point.style.left) + 15) + 'px';
        pointInfo.style.top = point.style.top;
        pointInfo.textContent = `${point.getAttribute('data-value')}`;
        imageContainer.appendChild(pointInfo);

        // QRコード生成ボタン
        const qrButton = document.createElement('button');
        qrButton.textContent = 'QRコード';
        // QRコード表示ボタンが押されたときの処理
        qrButton.addEventListener('click', () => {
            const value = point.getAttribute('data-value');
            const qrCodeImageURL = generateQRCode(value); // ここを変更する

            // QRコード画像を表示
            if (qrCodeImageURL) {
                alert(`QRコードを生成しました。`);
                const qrCodeImage = new Image();
                qrCodeImage.src = qrCodeImageURL;
                document.body.appendChild(qrCodeImage);
            } else {
                alert(`QRコードの生成に失敗しました。`);
            }
        });

        // 削除ボタン
        const deleteButton = document.createElement('button');
        deleteButton.textContent = '削除';
        deleteButton.addEventListener('click', () => {
            // ボタンがクリックされたらポイントを削除
            points.splice(rowIndex, 1);
            // ポイントとポイント情報を非表示にする
            point.remove();
            pointInfo.remove();
            // ポイントデータを Local Storage に保存
            localStorage.setItem('points', JSON.stringify(points));
            // テーブルを再描画
            displayPoints();
        });

        const cell2 = document.createElement('td');
        const cell3 = document.createElement('td');

        cell2.appendChild(qrButton);
        cell3.appendChild(deleteButton);

        return [pointInfo, cell2, cell3];
    }

    // ポイントを表示する処理
    function displayPoints() {
        pointsTableBody.innerHTML = ''; // テーブルの中身をクリア

        points.forEach((point, index) => {
            const { x, y, value } = point;
            const createdPoint = createPoint(x, y, value);
            imageContainer.appendChild(createdPoint);

            const [pointInfo, qrButtonCell, deleteButtonCell] = displayPointInfo(createdPoint, index);

            // テーブルにポイント情報を追加
            const row = pointsTableBody.insertRow(index);
            const cell1 = row.insertCell(0);
            cell1.textContent = value;

            row.appendChild(qrButtonCell);
            row.appendChild(deleteButtonCell);
        });
    }

        // ポイントを非表示にする処理
        function clearPoints() {
            // ポイントとポイント情報を非表示にする
            const allPoints = document.querySelectorAll('.point, .pointInfo');
            allPoints.forEach((point) => {
                point.remove();
            });

            points.length = 0;
        }

        // 「ポイント設定」ボタンが押されたときの処理
        setPointButton.addEventListener('click', () => {
            // メッセージを表示
            const message = prompt('場所を指定してください（クリックでポイントを設定）');

            // クリック時の処理を行う関数
            function handleClick(event) {
                // クリックされた座標を取得
                const x = event.clientX - imageContainer.getBoundingClientRect().left;
                const y = event.clientY - imageContainer.getBoundingClientRect().top;

                // ポイントに値を設定
                const value = prompt('ポイントの値を入力してください:');

                // ポイントを作成
                const point = { x, y, value };

                // ポイントを配列に追加
                points.push(point);

                // ポイントを表示
                displayPoints();

                // クリック時の処理を解除
                imageContainer.removeEventListener('click', handleClick);

                // メッセージを表示
                alert(`ポイントが設定されました。設定した値: ${value}, 座標: (${x}, ${y})`);

                // ポイントデータを Local Storage に保存
                localStorage.setItem('points', JSON.stringify(points));
            }

            // クリック時の処理を設定
            imageContainer.addEventListener('click', handleClick);
        });
});


