INSERT INTO users (user_password, access_level)
VALUES  (4ycm#jKQ_&*s4TV7e975, administrator),
        (wtyJ^K$%ETDY3n7J6_Kq, student),
        (aP3Ez7BTwJF^-7=@^GvT, student),
        (MUgwEumeHp8_QY#7+Acn, student),
        (e=S95n62wMyc++EYqkqV, administrator),
        (DHd5%gDMZzgm$qYMB5MD, student),
        (sa!wKHvuwF5_@DmsRC!t, student),
        (ab?6!*yN@j7@Sg#F&34@, super_administrator),
        (q@*K8YN3B2ERh&j*jL$2, student),
        (9p9Qj$N9#PJs&eczu8^N, administrator);


INSERT INTO rsos (rso_description, university_id)
VALUES  ('A club for cooking!', 1),
        ('A football club for experienced and seasoned players alike.', 2),
        ('Robot Club', 3),
        ('Tennis Club', 4),
        ('Association For Computing Machinery', 5),
        ('Association For Computing Machinery', 4),
        ('Tennis Club', 3),
        ('Tech Knights', 1),
        ('Gaming Knights', 1),
        ('Math Club', 2);

DELETE FROM events 
WHERE event_name = "Movie Night!";

SELECT * FROM events
WHERE event_privacy = "public"
AND university_id == 1;

SELECT userid FROM rso_member_lists
WHERE rso_owner = 'yes';

SELECT userid FROM rso_member_lists
WHERE rso_id = (
    SELECT rso_id FROM rsos 
    WHERE rso_description = 'Association For Computing Machinery'
);

SELECT event_name FROM events
WHERE rso_id = (
    SELECT rso_id FROM rso_member_lists
    WHERE userid = 123
);

SELECT access_level FROM users
WHERE userid = 456

