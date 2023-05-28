CREATE DATABASE tiemgiaycusaigon;
USE tiemgiaycusaigon;

CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(20),
  password VARCHAR(255) NOT NULL,
  avatar INT,
  FOREIGN KEY (avatar) REFERENCES product_images(id)
);	

CREATE TABLE addresses (
  id INT PRIMARY KEY AUTO_INCREMENT,
  number VARCHAR(10),
  street VARCHAR(255) NOT NULL,
  ward VARCHAR(255) NOT NULL,
  district VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL
);

CREATE TABLE user_addresses (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  address_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (address_id) REFERENCES addresses(id)
);

CREATE TABLE product_images (
  id INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT,
  image_path VARCHAR(255) NOT NULL,
  FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE categories (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  parent_category_id INT,
  FOREIGN KEY (parent_category_id) REFERENCES categories(id)
);

CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  category_id INT,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE product_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT,
  size VARCHAR(50),
  stock INT,
  FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE carts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE cart_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  cart_id INT,
  product_item_id INT,
  quantity INT,
  FOREIGN KEY (cart_id) REFERENCES carts(id),
  FOREIGN KEY (product_item_id) REFERENCES product_items(id)
);

CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  total_amount DECIMAL(10, 2),
  status VARCHAR(50),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT,
  product_item_id INT,
  quantity INT,
  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_item_id) REFERENCES product_items(id)
);


-- Insert mock data for the "categories" table
INSERT INTO categories (id, name, parent_category_id)
VALUES
  (1, 'Men', NULL),
  (2, 'Women', NULL),
  (3, 'Sports', 1),
  (4, 'Casual', 1),
  (5, 'Boots', 1),
  (6, 'Sneakers', 1),
  (7, 'Sports', 2),
  (8, 'Casual', 2),
  (9, 'Boots', 2),
  (10, 'Sneakers', 2);

-- Insert mock data for the "products" table
INSERT INTO products (id, name, description, category_id)
VALUES
  (1, 'Running Shoes', 'High-performance running shoes for athletes.', 3),
  (2, 'Casual Loafers', 'Comfortable and stylish loafers for everyday wear.', 4),
  (3, 'Ankle Boots', 'Trendy ankle boots for a fashionable look.', 5),
  (4, 'Classic Sneakers', 'Iconic sneakers with a timeless design.', 6),
  (5, 'Sports Sandals', 'Lightweight and durable sandals for sports activities.', 7),
  (6, 'Fashion Heels', 'Elegant high heels for special occasions.', 9);

-- Insert mock data for the "product_items" table
INSERT INTO product_items (id, product_id, size, stock)
VALUES
  (1, 1, 'US 9', 20),
  (2, 1, 'US 10', 15),
  (3, 2, 'US 8', 12),
  (4, 2, 'US 9', 18),
  (5, 3, 'US 7', 10),
  (6, 3, 'US 8', 14),
  (7, 4, 'US 9', 20),
  (8, 4, 'US 10', 16),
  (9, 5, 'US 11', 8),
  (10, 6, 'US 7', 6);

-- Insert mock data for the "users" table
INSERT INTO users (id, first_name, last_name, email, phone, password, avatar)
VALUES
  (1, 'John', 'Doe', 'johndoe@example.com', '1234567890', 'password123', 'avatar1.jpg'),
  (2, 'Jane', 'Smith', 'janesmith@example.com', '0987654321', 'password456', 'avatar2.jpg');

-- Insert mock data for the "addresses" table
INSERT INTO addresses (id, number, street, ward, district, city)
VALUES
  (1, '123', 'Main Street', 'Ward A', 'District X', 'City Y'),
  (2, '456', 'Broadway Avenue', 'Ward B', 'District Z', 'City Y');

-- Insert mock data for the "carts" table
INSERT INTO carts (id, user_id)
VALUES
  (1, 1),
  (2, 2);

-- Insert mock data for the "cart_items" table
INSERT INTO cart_items (id, cart_id, product_item_id, quantity)
VALUES
  (1, 1, 1, 2),
  (2, 1, 3, 1),
  (3, 2, 2, 1),
  (4, 2, 4, 3);

-- Insert mock data for the "orders" table
INSERT INTO orders (id, user_id, order_date, total_amount, status)
VALUES
  (1, 1, '2023-05-27 10:30:00', 250.50, 'Pending'),
  (2, 2, '2023-05-27 11:45:00', 120.00, 'Completed');

-- Insert mock data for the "order_items" table
INSERT INTO order_items (id, order_id, product_item_id, quantity)
VALUES
  (1, 1, 1, 2),
  (2, 1, 3, 1),
  (3, 2, 2, 1),
  (4, 2, 4, 3);

