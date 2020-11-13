CREATE TABLE IF NOT EXISTS products (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    description text NOT NULL,
    price decimal(5,2) NOT NULL,
    cost_price decimal(5,2) NOT NULL,
    stock int(11) NOT NULL,
    ean varchar(13) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO products (name, description, price, cost_price, stock, ean) VALUES
('Didgeridoo', 'An interesting instrument, I have two of them. They are hard to learn', '150.00', '50.00', 200, '9 12324 222'),
('Authentic Boomerang', 'A throwing stick that always comes back', '19.99', '9.98', 100, '9 32498 231'),
('Kangeroo Steak', 'The best meat on the planet.', '9.99', '5.99', 500, '9 12456 646'),
('Victoria Bitter', 'A nice australian beer.', '3.99', '1.99', 99, '9 98755 684'),
('Didgeridoo Stand', 'Useful for storing your didgeridoos', '99.99', '59.99', 2, '9 86354 854');