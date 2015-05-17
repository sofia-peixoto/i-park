INSERT INTO `ipark`.`parks`
(`Name`,`Company`,`Address`,`ZIPCode`,`ZIPLocation`,`Country`,`Latitude`,`Longitude`,`Phone`,
`OpeningHour`,`ClosingHour`,`PricePerHour`,`Floors`,`DisabledPlaces`,`Capacity`,`CreationDate`)
VALUES
('Parque Mariquinhas I','Parques da Mariquinhas','Rua dos cegos','4200-100','Por aí','Portugal',
'41.5423946','-8.3998443','212345678','09:00','23:00',1.2,2,10,200,NOW()),
('Parque Mariquinhas II','Parques da Mariquinhas','Avenida da Liberdade','4200-120','Por aí','Portugal',
'41.176861','-8.6667402','224356789','09:00','23:00',0.8,1,6,100,NOW()),
('Parque Mariquinhas III','Parques da Mariquinhas','Rua 2 de Novembro','4250-100','Por aí','Portugal',
'41.5492663','-8.4038408','212345678','09:00','00:00',1.6,2,10,220,NOW()),
('Parque do Quim','Unlimited Paking','Rua dos mancos','4300-100','Por aí','Portugal',
'41.5492663','-8.4038408','212345678','08:00','22:00',1.5,1,8,180,NOW()),
('Parque S. João','Unlimited Paking','Av. Aliados','4240-100','Por aí','Portugal',
'41.5419811','-8.4001125','245645623','08:00','23:00',1.1,3,20,330,NOW());

INSERT INTO `ipark`.`stocking`
(`ParkID`,`Value`,`Date`)
VALUES
(2,50,NOW()),
(3,76,NOW()),
(4,32,NOW()),
(5,12,NOW()),
(6,87,NOW())
