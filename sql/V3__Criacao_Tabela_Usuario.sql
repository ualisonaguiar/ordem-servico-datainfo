CREATE TABLE tb_usuario (
  id_usuario INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  no_usuario STRING(300) NOT NULL,
  nu_pis     VARCHAR(12) NOT NULL UNIQUE,
  ds_email   STRING(150) NOT NULL UNIQUE,
  ds_login   STRING(100) UNIQUE
);

CREATE TABLE tb_feriado (
  id_feriado INTEGER PRIMARY KEY AUTOINCREMENT,
  dt_feriado DATE NOT NULL,
  NO_FERIADO VARCHAR (150) NOT NULL,
  TP_FERIADO INTEGER NOT NULL -- Tipo de feriado. Onde: 1 - Nacional, 2 - Facultativo, 3 - Facultativo até as 14 horas, 4 - Facultativo após as 14 horas, 5 - Distrital.
);

Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-01-01','Confraternização Universal','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-02-08','Carnaval','2');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-02-09','Carnaval','2');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-02-10','Carnaval','3');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-03-25','Paixão de Cristo','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-04-21','Tiradentes','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-05-01','Dia Mundial do Trabalho','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-05-26','Corpus Christi','2');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-06-22','DDD','4');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-06-23','elvio','5');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-09-07','Independência do Brasil','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-10-12','Nossa Senhora Aparecida','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-10-28','Dia do Servidor Público - art. 236 da Lei nº 8.112, de 11 de dezembro de 1990','2');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-11-02','Finados','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-11-15','Proclamação da República','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-12-24','Véspera do Natal','4');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-12-25','Natal','1');
Insert into TB_FERIADO (ID_FERIADO, DT_FERIADO,NO_FERIADO,TP_FERIADO) values ((select (seq + 1) from sqlite_sequence WHERE name = 'tb_feriado'),'2016-12-31','Véspera de Ano Novo','4');