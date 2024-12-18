CREATE TABLE users (
    username VARCHAR(60) NOT NULL,
    password CHAR(60) NOT NULL,
   	PRIMARY KEY (username)
); 

CREATE TABLE article (
    articleId int NOT NULL AUTO_INCREMENT,
    articleTitle CHAR(200) NOT NULL,
    shortTitle CHAR(16) NOT NULL,
    articleBody LONGTEXT,
    username VARCHAR(60) NOT NULL,
    PRIMARY KEY(articleId),
    FOREIGN KEY (username) REFERENCES users(username)
);

