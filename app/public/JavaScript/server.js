const express = require('express');
const bcrypt = require('bcrypt');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public')); // 静的ファイル（HTML、CSS、JS）を提供するために public フォルダを使用

// サンプルの管理者ユーザー情報
const adminUser = {
    username: 'admin',
    // bcrypt を使用してパスワードをハッシュ化
    passwordHash: '$2b$10$RK1w5.XDylZAB9KjFwRVDuGix2xcVhvRaZcXSN2abZ5nIiYPPHfZy'
};

// ログインページを表示
app.get('/login', (req, res) => {
    res.sendFile(__dirname + '/public/login.html');
});

// ログイン処理
app.post('/login', (req, res) => {
    const username = req.body.username;
    const password = req.body.password;

    // ユーザー名が存在し、パスワードが一致するかを確認
    if (username === adminUser.username && bcrypt.compareSync(password, adminUser.passwordHash)) {
        res.send('Login successful!');
    } else {
        res.status(401).send('Invalid credentials');
    }
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
