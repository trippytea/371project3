CREATE TABLE users (
    username VARCHAR(60) NOT NULL,
    password CHAR(60) NOT NULL,
   	PRIMARY KEY (username)
); 

CREATE TABLE article {
    articleId NOT NULL AUTO_INCREMENT,
    articleTitle CHAR(60) NOT NULL,
    articleBody VARCHAR(MAX),
    username VARCHAR(60) NOT NULL,
    PRIMARY KEY(articleId),
    FOREIGN KEY username REFERENCES users(username)
};

