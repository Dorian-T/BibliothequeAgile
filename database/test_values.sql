INSERT INTO Category(id, name) VALUES
    (1, 'Litterature'),
    (2, 'Jeunesse'),
    (3, 'SHS'),
    (4, 'Poesie'),
    (5, 'Conte philosophique'),
    (6, 'Developpement personnel')
;

INSERT INTO Customer(id, first_name, last_name, birth_date, phone, email, password, is_admin) VALUES
    (1, 'Jean', 'Dupont', '1990-01-01', 1234567890, 'jeandupont@mail.com', 'JDpwd+1990', 0),
    (2, 'Jeanne', 'Martin', '1995-02-02', 1234567890, 'jeannemartin@mail.com', 'JMpwd+1995', 1)
;

INSERT INTO Book(id, title, author, edition, publication_year, genre, location, borrowed_by) VALUES
    (1, 'Veiller sur elle', 'Jean-Baptiste Andrea', 'L''iconoclaste', 2023, 1, 'A1', NULL),
    (2, 'Des diables et des saints', 'Jean-Baptiste Andrea', 'Collection poche', 2022, 1, 'A1', NULL),
    (3, 'Psychopompe', 'Amelie Nothomb', 'Albin Michel', 2023, 1, 'A1', NULL),
    (4, 'Changer l''eau des fleurs', 'Valerie Perrin', 'Albin Michel', 2018, 1, 'A1', NULL),
    (5, 'Les oublies du dimanche', 'Valerie Perrin', 'Le livre de poche', 2017, 1, 'A1', NULL),
    (6, 'Au revoir de la-haut', 'Pierre Lemaitre', 'Le livre de poche', 2015, 1, 'A1', NULL),
    (7, 'Les yeux de Mona', 'Thomas Schlesser', 'Albin Michel', 2024, 1, 'A1', NULL),
    (8, 'Ce qu''il reste a faire', 'Marie de Chassey', 'Alma Editeur', 2023, 1,	'A1', NULL),
    (9, 'Les tourmentes', 'Lucas Belvaux', 'Alma Editeur', 2022, 1,	'A1', NULL),
    (10, 'Sur la plage', 'Juliette Willerval', 'Alma Editeur', 2024, 1, 'A1', NULL),
    (11, 'Oskar et le comte', 'Jean-Baptiste Drouot', 'Les fourmis rouges', 2024, 2, 'A2', NULL),
    (12, 'Rendez-vous a la piscine', 'Jean-Baptiste Drouot', 'Helium', 2023, 2, 'A2', NULL),
    (13, 'J''ai oublie mon expose parce que ...', 'D Cali, B Chaud', 'Helium', 2024, 2, 'A2', NULL),
    (14, 'Sois jeune et tais toi : reponse a ceux qui critiquent la jeunesse', 'Salome Saque', 'Payot', 2024, 3, 'A3', NULL),
    (15, 'Le muguet rouge', 'Christian Bobin', 'Folio', 2024, 4, 'A4', NULL),
    (16, 'Paroles', 'Jacques Prevert', 'Folio', 1976, 4, 'A4', NULL),
    (17, 'L''Ame du monde - 1', 'Frederic Lenoir', 'Poket', 2014, 5, 'A5', NULL),
    (18, 'L''Ame du monde - 2', 'Frederic Lenoir', 'Poket', 2023, 5, 'A5', NULL),
    (19, 'Les quatres accords tolteques', 'Miguel Ruiz', 'Poche Jouvence', 2016, 6, 'A6', NULL),
    (20, 'Jung, un voyage vers soi', 'Frederic Lenoir', 'Le livre de poche', 2023, 3, 'A3', NULL)
;

INSERT INTO Borrowing(book_id, customer_id) VALUES
    (1, 1),
    (2, 1),
    (3, 2)
;

INSERT INTO Reservation(book_id, customer_id) VALUES
    (4, 1),
    (5, 1),
    (6, 2)
;