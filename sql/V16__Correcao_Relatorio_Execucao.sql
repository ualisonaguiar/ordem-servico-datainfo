PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                        FROM tb_usuario;

DROP TABLE tb_usuario;

CREATE TABLE tb_usuario (
  id_usuario  INTEGER      PRIMARY KEY AUTOINCREMENT
                           NOT NULL,
  no_usuario  STRING (300) NOT NULL,
  nu_pis      VARCHAR (12) NOT NULL
    UNIQUE,
  ds_email    STRING (150) NOT NULL
    UNIQUE,
  ds_login    STRING (100) UNIQUE,
  in_preposto BOOLEAN,
  in_ativo    BOOLEAN      DEFAULT (1)
);

INSERT INTO tb_usuario (
  id_usuario,
  no_usuario,
  nu_pis,
  ds_email,
  ds_login
)
  SELECT id_usuario,
    no_usuario,
    nu_pis,
    ds_email,
    ds_login
  FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;

update tb_usuario set in_preposto = 1 where id_usuario in (1, 13);
