USE project;

CREATE TABLE universities(
    university_id INT NOT NULL AUTO_INCREMENT,
    university_name VARCHAR(50),
    university_location VARCHAR(500),
    PRIMARY KEY (university_id),
    UNIQUE(university_id)
);

CREATE TABLE rsos(
    rso_id INT NOT NULL AUTO_INCREMENT,
    rso_description TEXT,
    university_id INT NOT NULL,
    PRIMARY KEY (rso_id),
    CONSTRAINT university_id FOREIGN KEY (university_id)
    REFERENCES universities(university_id),
    UNIQUE(rso_id) 
);

CREATE TABLE users(
    userid INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    user_password VARCHAR(50) NOT NULL,
    user_univ VARCHAR(10),
    access_level INT NOT NULL,
    PRIMARY KEY (userid),
    UNIQUE (userid)
);

CREATE TABLE rso_member_lists(
    rso_id INT NOT NULL,
    userid INT NOT NULL,
    rso_owner VARCHAR(5),
    CONSTRAINT rso_id FOREIGN KEY (rso_id)
    REFERENCES rsos(rso_id),
    CONSTRAINT userid FOREIGN KEY (userid)
    REFERENCES users(userid)
);

CREATE TABLE events(
    event_id INT NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(150),
    event_category VARCHAR(25),
    event_time DATETIME,
    event_contact_phone VARCHAR(15),
    event_contact_email VARCHAR(50),
    event_privacy VARCHAR(10),
    event_location_name VARCHAR(50),
    event_location_latitude REAL,
    event_location_longitude REAL,
    owner_id INT NOT NULL,
    rso_id INT,
    university_id INT,
    PRIMARY KEY (event_id)
);