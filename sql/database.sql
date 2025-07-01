-- database.sql - Base de datos para Casa Taller Cachagua
-- Crear y usar la base de datos
CREATE DATABASE IF NOT EXISTS casa_taller_cachagua;
USE casa_taller_cachagua;

-- Tabla de usuarios administradores
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    instagram_link VARCHAR(255),
    categoria VARCHAR(50),
    orden INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar productos de ejemplo
INSERT INTO productos (nombre, imagen, instagram_link, categoria) VALUES
('Pintura Abstracta Mar', 'pintura1.jpg', 'https://www.instagram.com/p/C433TMCxzDr/?img_index=1', 'pinturas'),
('Grabados serie CAMINOS', 'ceramica1.jpg', 'https://www.instagram.com/p/C4q_U91xR-d/?img_index=3', 'pinturas'),
('Matrices de Xilografias "Los Caminos "', 'grabado1.jpg', 'https://www.instagram.com/p/C0sDpuHxb2x/?img_index=3', 'grabados'),
('La primavera cabeza de ceramica gres', 'escultura1.jpg', 'https://www.instagram.com/p/CyMb0xERW-O/ ', 'esculturas'),
('lamparas de ceramica gres', 'pintura2.jpg', 'https://www.instagram.com/p/CyUJ4TARi6-/?img_index=1', 'esculturas'),
('Jarrón de Cerámica', 'ceramica2.jpg', 'https://instagram.com/p/pqr678', 'ceramica'),
('Xilografía Costa', 'grabado2.jpg', 'https://instagram.com/p/stu901', 'grabados'),
('Pintura Marina', 'pintura3.jpg', 'https://instagram.com/p/vwx234', 'pinturas');

-- Insertar mensajes de ejemplo
INSERT INTO contactos (nombre, email, telefono, mensaje) VALUES
('María González', 'maria@email.com', '+56912345678', 'Hola, me interesa conocer más sobre sus productos de cerámica.'),
('Juan Pérez', 'juan@email.com', '+56987654321', 'Quisiera visitar el taller este fin de semana, ¿cuál es el horario?'),
('Ana Silva', 'ana@email.com', '+56911223344', 'Hermoso trabajo! Me gustaría encargar una pieza personalizada.');