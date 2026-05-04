USE autorent;

DELETE FROM cars;

INSERT INTO cars (mark, model, engine, fuel, price, image, year, transmission, seats, description, status) VALUES
('BMW', '320d', '2.0 Diesel', 'diisel', 49.90, 'https://images.unsplash.com/photo-1555215695-3004980ad54e?q=80&w=1200&auto=format&fit=crop', 2020, 'automaat', 5, 'Mugav ja ökonoomne sedaan igapäevaseks sõiduks.', 'hoolduses'),

('Toyota', 'RAV4', '2.5 Hybrid', 'hübriid', 64.90, 'https://images.unsplash.com/photo-1581540222194-0def2dda95b8?q=80&w=1200&auto=format&fit=crop', 2022, 'automaat', 5, 'Ruumikas ja mugav linnamaastur perele.', 'vaba'),

('Volvo', 'XC60', '2.0 D4', 'diisel', 79.90, 'https://images.unsplash.com/photo-1563720223185-11003d516935?q=80&w=1200&auto=format&fit=crop', 2021, 'automaat', 5, 'Turvaline ja elegantne premium SUV.', 'vaba'),

('Subaru', 'Forester', '2.0 AWD', 'bensiin', 67.90, 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?q=80&w=1200&auto=format&fit=crop', 2021, 'automaat', 5, 'Neliveoline ja vastupidav auto igaks hooajaks.', 'vaba'),

('Ford', 'Mustang Mach-E', 'Electric', 'elekter', 89.90, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?q=80&w=1200&auto=format&fit=crop', 2023, 'automaat', 5, 'Täiselektriline modernne linnamaastur.', 'vaba'),

('Mercedes-Benz', 'AMG GT', '4.0 V8', 'bensiin', 149.90, 'https://images.unsplash.com/photo-1618843479617-8f4e0c2f9c1e?q=80&w=1200&auto=format&fit=crop', 2022, 'automaat', 4, 'Luksuslik ja sportlik premium-klassi kupee.', 'renditud'),

('Porsche', '911 Carrera S', '3.0 Turbo', 'bensiin', 179.90, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200&auto=format&fit=crop', 2023, 'automaat', 4, 'Legendaarne sportauto tõelisele sõidunautlejale.', 'vaba'),

('Mitsubishi', 'Lancer Evolution X', '2.0 Turbo', 'bensiin', 99.90, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=1200&auto=format&fit=crop', 2018, 'manuaal', 5, 'Ikoniline sportlik sedaan võimsa iseloomuga.', 'vaba');
