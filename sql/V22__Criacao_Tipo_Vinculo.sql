PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                        FROM tb_usuario;

DROP TABLE tb_usuario;

CREATE TABLE tb_usuario (
  id_usuario INTEGER      PRIMARY KEY AUTOINCREMENT
                          NOT NULL,
  no_usuario STRING (300) NOT NULL,
  nu_pis     VARCHAR (12) UNIQUE,
  ds_email   STRING (150) NOT NULL
    UNIQUE,
  ds_login   STRING (100) UNIQUE,
  tp_vinculo INTEGER,
  in_ativo   BOOLEAN      DEFAULT (1)
);

INSERT INTO tb_usuario (
  id_usuario,
  no_usuario,
  nu_pis,
  ds_email,
  ds_login,
  in_ativo
)
  SELECT id_usuario,
    no_usuario,
    nu_pis,
    ds_email,
    ds_login,
    in_ativo
  FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;

update tb_usuario set tp_vinculo = 1 where tp_vinculo is null;

PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                        FROM tb_usuario;

DROP TABLE tb_usuario;

CREATE TABLE tb_usuario (
  id_usuario INTEGER      PRIMARY KEY AUTOINCREMENT
                          NOT NULL,
  no_usuario STRING (300) NOT NULL,
  nu_pis     VARCHAR (12) UNIQUE,
  ds_email   STRING (150) NOT NULL
    UNIQUE,
  ds_login   STRING (100) UNIQUE,
  tp_vinculo INTEGER      NOT NULL,
  in_ativo   BOOLEAN      DEFAULT (1)
);

INSERT INTO tb_usuario (
  id_usuario,
  no_usuario,
  nu_pis,
  ds_email,
  ds_login,
  tp_vinculo,
  in_ativo
)
  SELECT id_usuario,
    no_usuario,
    nu_pis,
    ds_email,
    ds_login,
    tp_vinculo,
    in_ativo
  FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;

update tb_usuario set tp_vinculo = 2 where id_usuario in (1, 13, 21);

update tb_ordem_servico set no_gestor_contrato = 'Camilo Mussi', no_fiscal_requisitante = 'Carlos Roberto Porfírio Júnior', no_fiscal_tecnico = 'Carlos Roberto Porfírio Júnior'  where nu_ordem_servico in (921, 918, 915, 912, 911, 910);