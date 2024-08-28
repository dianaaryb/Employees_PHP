DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS phone;

CREATE TABLE contact (id INTEGER PRIMARY KEY AUTO_INCREMENT,
                      name VARCHAR(255));

CREATE TABLE phone (contact_id INTEGER, number VARCHAR(255));

INSERT INTO contact VALUES (null, 'Alice');
INSERT INTO contact VALUES (null, 'Bob');
INSERT INTO contact VALUES (null, 'Carol');

INSERT INTO phone VALUES (1, '123');
INSERT INTO phone VALUES (2, '456');
INSERT INTO phone VALUES (2, '789');
INSERT INTO phone VALUES (1, '555');

# update test set last_name = 'Smith', first_name = 'Bob' where id = 2;
# delete from test where id = 2;

# select * from contact;


# select * from contact, phone; // contact rows * phone rows(3*4) on palju mitte moistlikku rida

# filtreerib ainult moistlikud read
# select * from contact, phone where contact.id = phone.contact_id;
# select * from contact, phone where contact.id = phone.contact_id and phone.number = '123';
# select * from contact, phone where contact.id = phone.contact_id and contact.id = 1;
