
-- ================================
-- SCRIPT DE CARGA DE DATOS DE PRUEBA
-- ================================

-- USUARIOS
INSERT INTO usuario (id_usuario, nombre, correo, contraseña, rol, fecha_registro) VALUES
(1, 'Admin Principal', 'admin@edutalleres.com', 'admin123', 4, NOW()),
(2, 'Benito Gómez', 'benito@correo.com', 'padre123', 1, NOW()),
(3, 'Roberto Carías', 'roberto@correo.com', 'padre123', 1, NOW()),
(4, 'Itzel Andrade', 'itzel@correo.com', 'estu123', 2, NOW()),
(5, 'Gael Navarro', 'gael@correo.com', 'estu123', 2, NOW()),
(6, 'Leticia Ruiz', 'leticia@correo.com', 'instructor123', 3, NOW()),
(7, 'Héctor Duarte', 'hector@correo.com', 'instructor123', 3, NOW());

-- RELACIÓN PADRE-ESTUDIANTE
INSERT INTO padre_estudiante (id_padre, id_estudiante) VALUES
(2, 4), -- Benito es padre de Itzel
(3, 5); -- Roberto es padre de Gael

-- TALLERES
INSERT INTO talleres (id_talleres, id_instructor, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(1, 6, 'Taller de Pintura Creativa', 'Explora técnicas de pintura modernas', '2025-07-10', '2025-08-10'),
(2, 7, 'Taller de Robótica Infantil', 'Aprende robótica con kits educativos', '2025-07-15', '2025-08-20');

-- HORARIOS
INSERT INTO horario (id_horario, id_talleres, dia, hora_inicio, hora_fin) VALUES
(1, 1, 'Lunes', '14:00:00', '16:00:00'),
(2, 2, 'Miércoles', '10:00:00', '12:00:00');

-- INSCRIPCIONES
INSERT INTO inscripcion (id_inscripcion, id_estudiante, id_talleres, fecha) VALUES
(1, 4, 1, '2025-07-08'), -- Itzel inscrita en Pintura
(2, 5, 2, '2025-07-10'); -- Gael inscrito en Robótica

-- ASISTENCIAS
INSERT INTO asistencia (id_asistencia, id_inscripcion, fecha, presente) VALUES
(1, 1, '2025-07-15', TRUE),
(2, 1, '2025-07-17', FALSE),
(3, 2, '2025-07-17', TRUE);

-- CALIFICACIONES
INSERT INTO calificacion (id_calificacion, id_inscripcion, nota) VALUES
(1, 1, 87.5),
(2, 2, 91.0);

-- NOTIFICACIONES
INSERT INTO notificacion (id_notificacion, mensaje, fecha, tipo) VALUES
(1, 'El taller de pintura tendrá una sesión adicional el viernes.', '2025-07-12', 'informativa'),
(2, 'Recuerda que la clase de robótica inicia este miércoles.', '2025-07-13', 'recordatorio');

-- NOTIFICACIONES ASOCIADAS A USUARIOS
INSERT INTO usuario_notificacion (id_usuario, id_notificacion) VALUES
(2, 1),
(3, 2),
(4, 1),
(5, 2);
