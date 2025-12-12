-- ============================
-- TIPOS DE ASOCIACIÓN (10)
-- ============================
INSERT INTO tipo_asoc (nombre) VALUES
("Niños"),
("Mujeres"),
("Mayores"),
("Refugiados"),
("Animales"),
("Bosques"),
("Oceánicas"),
("Indígenas"),
("Comunidad"),
("Educativa");

-- ============================
-- TIPOS DE CONTRIBUCIÓN (20)
-- ============================
INSERT INTO contribucion (descripcion) VALUES
("Salud"),
("Educación"),
("Protección Infantil"),
("Alimentos"),
("Agua Potable"),
("Medio Ambiente"),
("Reforestación"),
("Emergencias"),
("Refugio"),
("Derechos Humanos"),
("Igualdad"),
("Inclusión"),
("Animales"),
("Sostenibilidad"),
("Energía Limpia"),
("Conservación Marina"),
("Apoyo Psicológico"),
("Formación"),
("Investigación"),
("Voluntariado");

-- ============================
-- ASOCIACIONES (50)
-- ============================

INSERT INTO asociacion (nombre, fecha_fun, pista_facil, pista_media, pista_dificil, imagen, idTipoAsoc, alcance) VALUES
("Cruz Roja", 1863, "Ayuda humanitaria global", "Presente en casi todos los países", "Fundada en 1863 en Suiza", "cruz_roja.png", 9, 'I'),
("UNICEF", 1946, "Defiende los derechos de los niños", "Actúa en más de 190 países", "Fundada por la ONU en 1946", "unicef.jpg", 1, 'I'),
("WWF", 1961, "Protege animales y naturaleza", "Trabaja por la vida silvestre", "Fundada en 1961", "wwf.png", 5, 'I'),
("Greenpeace", 1971, "Organización ambiental", "Activismo por el planeta", "Creada en 1971", "greenpeace.png", 7, 'I'),
("Save the Children", 1919, "Protege a la infancia", "Actúa en emergencias", "Fundada en 1919", "save_the_children.png", 1, 'I'),
("Amnistía Internacional", 1961, "Defiende derechos humanos", "Campañas globales", "Fundada en 1961", "amnistia_internacional.png", 9, 'I'),
("ACNUR", 1950, "Apoya a refugiados", "Organismo de la ONU", "Creada en 1950", "acnur.png", 4, 'I'),
("Médicos Sin Fronteras", 1971, "Ayuda médica urgente", "Actúa en zonas de riesgo", "Fundada en 1971", "medicos_sin_fronteras.png", 9, 'I'),
("Oxfam", 1942, "Lucha contra la pobreza", "Actúa en 90 países", "Fundada en 1942", "oxfam.png", 9, 'I'),
("Aldeas Infantiles SOS", 1949, "Protege a niños sin familia", "Presente en 130 países", "Inició en 1949", "aldeas_infantiles_sos.png", 1, 'I'),
("Fundación ONCE", 1988, "Apoya a personas con discapacidad", "Centrada en inclusión", "Fundada en 1988", "fundacion_once.jpg", 9, 'N'),
("Manos Unidas", 1960, "Lucha contra el hambre", "ONG española", "Formada en 1960", "manos_unidas.png", 9, 'N'),
("Cáritas", 1897, "Ayuda social", "Red internacional", "Fundada en 1897", "caritas.png", 9, 'I'),
("World Vision", 1950, "Protege a la infancia", "Ayuda global humanitaria", "Fundada en 1950", "world_vision.png", 1, 'I'),
("Plan International", 1937, "Defensa infantil", "Empodera especialmente a niñas", "Nació en 1937", "plan_international.png", 1, 'I'),
("PETA", 1980, "Defensa de los animales", "Activismo global", "Fundada en 1980", "peta.png", 5, 'I'),
("Human Rights Watch", 1978, "Derechos humanos", "Investigación global", "Creada en 1978", "human_rights_watch.png", 9, 'I'),
("Sea Shepherd", 1977, "Protección marina", "Defiende océanos", "Fundada en 1977", "sea_shepherd.png", 7, 'I'),
("The Nature Conservancy", 1951, "Protege ecosistemas", "Actúa en 70 países", "Creada en 1951", "the_nature_conservancy.png", 6, 'I'),
("Rainforest Alliance", 1987, "Protege bosques", "Certificación sostenible", "Creada en 1987", "rainforest_alliance.png", 6, 'I'),
("Reforestamos México", 2002, "Protege bosques", "ONG mexicana", "Fundada en 2002", "reforestamos_mexico.png", 6, 'N'),
("Global Footprint Network", 2003, "Huella ecológica", "Datos ambientales", "Creada en 2003", "global_footprint_network.png", 7, 'I'),
("Fundación Natura Ecuador", 1978, "Conservación ambiental", "Trabaja en Ecuador", "Desde 1978", "fundacion_natura_ecuador.png", 6, 'N'),
("TECHO", 1997, "Construye viviendas", "Apoya a comunidades pobres", "Fundado en 1997", "techo.png", 9, 'I'),
("Bombers Sense Fronteres", 1996, "Ayuda en emergencias", "Bomberos voluntarios", "Creada en 1996", "bombers_sense_fronteres.png", 9, 'N'),
("Proactiva Open Arms", 2015, "Rescate marítimo", "Ayuda a migrantes", "Nació en 2015", "proactiva_open_arms.png", 4, 'I'),
("Fundación Vicente Ferrer", 1969, "Ayuda en India", "Trabajo rural", "Fundada en 1969", "fundacion_vicente_ferrer.png", 9, 'I'),
("AquaFund", 2010, "Acceso a agua potable", "Promueve saneamiento", "Fundada en 2010", "aquafund.png", 9, 'I'),
("Earthwatch", 1971, "Investigación ambiental", "Voluntariado científico", "Creada en 1971", "earthwatch.png", 7, 'I'),
("CARE", 1945, "Ayuda humanitaria", "Actúa en emergencias", "Fundada en 1945", "care.png", 9, 'I'),
("Feeding America", 1979, "Bancos de alimentos", "Ayuda en EE.UU.", "Nació en 1979", "feeding_america.png", 9, 'N'),
("SOS Amazonia", 1998, "Protege Amazonía", "Ayuda a comunidades", "Fundada en 1998", "sos_amazonia.png", 8, 'L'),
("Reef Check", 1996, "Corales del mundo", "Monitoreo marino", "Creada en 1996", "reef_check.jpg", 7, 'I'),
("Polar Bears International", 1994, "Protege osos polares", "Investigación del Ártico", "Fundada en 1994", "polar_bears_international.png", 5, 'I'),
("Good Neighbors", 1991, "Apoya comunidades", "ONG global", "Desde 1991", "good_neighbors.png", 9, 'I'),
("World Animal Protection", 1981, "Protección animal", "Acción global", "Fundada en 1981", "world_animal_protection.png", 5, 'I'),
("WaterAid", 1981, "Acceso al agua", "Trabajo sanitario", "Creada en 1981", "wateraid.png", 9, 'I'),
("Operation Smile", 1982, "Cirugías reconstructivas", "Niños con fisura labial", "Fundada en 1982", "operation_smile.jpg", 1, 'I'),
("Heifer International", 1944, "Desarrollo rural", "Apoya a familias", "Desde 1944", "heifer_international.png", 9, 'I'),
("Mercy Corps", 1979, "Emergencias globales", "Ayuda humanitaria", "Fundada en 1979", "mercy_corps.png", 9, 'I'),
("Global Green", 1994, "Sostenibilidad urbana", "Iniciativas verdes", "Creada en 1994", "global_green.png", 7, 'I'),
("Plant for the Planet", 2007, "Reforestación mundial", "Liderado por jóvenes", "Fundada en 2007", "plant_for_the_planet.png", 6, 'I'),
("Fundación MAPFRE", 1975, "Acción social", "Seguridad vial y salud", "Formada en 1975", "fundacion_mapfre.png", 9, 'N'),
("Fundación ANAR", 1970, "Ayuda a niños", "Línea de ayuda", "Fundada en 1970", "fundacion_anar.png", 1, 'N'),
("Endangered Species Coalition", 1980, "Protege especies", "Acción en EE.UU.", "Desde 1980", "endangered_species_coalition.png", 5, 'N'),
("Friends of the Earth", 1969, "Activismo ambiental", "Red global", "Fundada en 1969", "friends_of_the_earth.png", 7, 'I'),
("Humane Society", 1954, "Protección animal", "Organización en EE.UU.", "Desde 1954", "humane_society.jpg", 5, 'N'),
("World Food Programme", 1961, "Comida en emergencias", "Programa de la ONU", "Creado en 1961", "world_food_programme.png", 9, 'I'),
("Ashoka", 1980, "Emprendimiento social", "Innovación global", "Fundada en 1980", "ashoka.png", 9, 'I'),
("Fundación Loyola", 1998, "Educación integral y social", "Presente en Andalucía, Canarias y Extremadura", "Vinculada a educación social y jesuita", "fundacion_loyola.jpg", 9, 'N');

-- ========================================
-- RELACIONES ASOCIACIÓN-CONTRIBUCIÓN
-- ========================================

INSERT INTO asoc_contribucion (idAsoc, idContribucion) VALUES
-- 1 Cruz Roja
(1,1),(1,8),(1,9),
-- 2 UNICEF
(2,3),(2,1),(2,2),
-- 3 WWF
(3,6),(3,14),(3,19),
-- 4 Greenpeace
(4,6),(4,14),(4,16),
-- 5 Save the Children
(5,3),(5,1),(5,4),
-- 6 Amnistía Internacional
(6,10),(6,11),(6,12),
-- 7 ACNUR
(7,8),(7,9),(7,10),
-- 8 Médicos Sin Fronteras
(8,1),(8,8),(8,17),
-- 9 Oxfam
(9,4),(9,10),(9,11),
-- 10 Aldeas Infantiles SOS
(10,3),(10,1),(10,12),
-- 11 Fundación ONCE
(11,12),(11,2),(11,17),
-- 12 Manos Unidas
(12,4),(12,8),(12,2),
-- 13 Cáritas
(13,4),(13,1),(13,8),
-- 14 World Vision
(14,3),(14,1),(14,4),
-- 15 Plan International
(15,3),(15,11),(15,12),
-- 16 PETA
(16,13),(16,6),
-- 17 Human Rights Watch
(17,10),(17,11),(17,12),
-- 18 Sea Shepherd
(18,16),(18,6),(18,14),
-- 19 The Nature Conservancy
(19,6),(19,14),(19,19),
-- 20 Rainforest Alliance
(20,6),(20,14),
-- 21 Reforestamos México
(21,6),(21,7),
-- 22 Global Footprint Network
(22,6),(22,19),
-- 23 Fundación Natura Ecuador
(23,6),(23,14),
-- 24 TECHO
(24,9),(24,8),(24,4),
-- 25 Bombers Sense Fronteres
(25,8),(25,9),
-- 26 Proactiva Open Arms
(26,9),(26,8),
-- 27 Fundación Vicente Ferrer
(27,4),(27,17),(27,18),
-- 28 AquaFund
(28,5),(28,14),
-- 29 Earthwatch
(29,19),(29,17),
-- 30 CARE
(30,1),(30,8),
-- 31 Feeding America
(31,4),(31,5),
-- 32 SOS Amazonia
(32,6),(32,7),
-- 33 Reef Check
(33,16),(33,6),
-- 34 Polar Bears International
(34,5),(34,13),
-- 35 Good Neighbors
(35,4),(35,17),
-- 36 World Animal Protection
(36,13),(36,6),
-- 37 WaterAid
(37,5),(37,8),
-- 38 Operation Smile
(38,1),(38,17),
-- 39 Heifer International
(39,4),(39,5),(39,8),
-- 40 Mercy Corps
(40,1),(40,8),
-- 41 Global Green
(41,14),(41,15),
-- 42 Plant-for-the-Planet
(42,7),(42,14),
-- 43 Fundación MAPFRE
(43,1),(43,4),
-- 44 Fundación ANAR
(44,3),(44,17),
-- 45 Endangered Species Coalition
(45,13),(45,6),
-- 46 Friends of the Earth
(46,6),(46,14),
-- 47 Humane Society
(47,13),(47,6),
-- 48 World Food Programme
(48,4),(48,5),(48,8),
-- 49 Ashoka
(49,18),(49,19),
-- 50 Fundación Loyola
(50,2),(50,18),(50,12);