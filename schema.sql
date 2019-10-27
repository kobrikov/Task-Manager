CREATE DATABASE taskmanager
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskmanager;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  u_reg DATETIME,
  u_email VARCHAR(64),
  u_name VARCHAR(128),
  u_password VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE status (
  id INT AUTO_INCREMENT PRIMARY KEY,
  s_name VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE priority (
  id INT AUTO_INCREMENT PRIMARY KEY,
  p_name VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  t_reg DATETIME,
  t_name VARCHAR(128),
  t_desc TEXT,
  t_time DATETIME,
  t_state VARCHAR(64),
  user_id INT,
  status_id INT,
  priority_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (status_id) REFERENCES status(id),
  FOREIGN KEY (priority_id) REFERENCES priority(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
