const bcrypt = require('bcrypt');

async function generateHashedPassword() {
    // ハッシュ化したいパスワードを入力
    const rawPassword = 'Yous-Chime-ota';

    // パスワードをハッシュ化
    const saltRounds = 10; // ソルトの強度（10が一般的）
    const hashedPassword = await bcrypt.hash(rawPassword, saltRounds);

    // ハッシュ化された値を表示
    console.log(hashedPassword);
}

generateHashedPassword();
