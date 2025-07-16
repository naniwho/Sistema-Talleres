
-- Tabla de usuarios
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL,
    rol INT NOT NULL, -- 1=padre, 2=estudiante, 3=instructor, 4=admin
    fecha_registro DATE
);

-- Relación entre padres y estudiantes
CREATE TABLE padre_estudiante (
    id_padre INT,
    id_estudiante INT,
    PRIMARY KEY (id_padre, id_estudiante),
    FOREIGN KEY (id_padre) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_estudiante) REFERENCES usuario(id_usuario)
);

-- Tabla de talleres
CREATE TABLE talleres (
    id_talleres INT AUTO_INCREMENT PRIMARY KEY,
    id_instructor INT NOT NULL,
    nombre VARCHAR(100),
    descripcion TEXT,
    fecha_inicio DATE,
    fecha_fin DATE,
    FOREIGN KEY (id_instructor) REFERENCES usuario(id_usuario)
);

-- Horarios de talleres
CREATE TABLE horario (
    id_horario INT AUTO_INCREMENT PRIMARY KEY,
    id_talleres INT,
    dia VARCHAR(20),
    hora_inicio TIME,
    hora_fin TIME,
    FOREIGN KEY (id_talleres) REFERENCES talleres(id_talleres)
);

-- Inscripciones de estudiantes a talleres
CREATE TABLE inscripcion (
    id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT,
    id_talleres INT,
    fecha DATE,
    FOREIGN KEY (id_estudiante) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_talleres) REFERENCES talleres(id_talleres)
);

-- Asistencias a talleres
CREATE TABLE asistencia (
    id_asistencia INT AUTO_INCREMENT PRIMARY KEY,
    id_inscripcion INT,
    fecha DATE,
    presente BOOLEAN,
    FOREIGN KEY (id_inscripcion) REFERENCES inscripcion(id_inscripcion)
);

-- Calificaciones por taller
CREATE TABLE calificacion (
    id_calificacion INT AUTO_INCREMENT PRIMARY KEY,
    id_inscripcion INT,
    nota DECIMAL(5,2),
    FOREIGN KEY (id_inscripcion) REFERENCES inscripcion(id_inscripcion)
);

-- Notificaciones
CREATE TABLE notificacion (
    id_notificacion INT AUTO_INCREMENT PRIMARY KEY,
    mensaje TEXT,
    fecha DATE,
    tipo VARCHAR(30)
);

-- Relación notificación-usuario (si una notificación va a varios usuarios)
CREATE TABLE usuario_notificacion (
    id_usuario INT,
    id_notificacion INT,
    PRIMARY KEY (id_usuario, id_notificacion),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_notificacion) REFERENCES notificacion(id_notificacion)
);
