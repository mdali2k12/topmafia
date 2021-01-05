
DROP DATABASE IF EXISTS topmafia;
CREATE DATABASE IF NOT EXISTS topmafia CHARACTER SET utf8;
CREATE USER IF NOT EXISTS 'topmafia' IDENTIFIED BY 'topmafia';
GRANT ALL PRIVILEGES ON topmafia.* TO 'topmafia';
FLUSH PRIVILEGES;