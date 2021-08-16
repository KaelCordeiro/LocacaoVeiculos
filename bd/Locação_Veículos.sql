create database LocacaoVeiculos;
use LocacaoVeiculos;

CREATE TABLE `usuario` ( 
	`usu_tipo` int NOT NULL,
    `usu_perfil` varchar(45),
    PRIMARY KEY (`usu_tipo`)
);

INSERT INTO `usuario` VALUES
(1,'Cliente'),
(2,'Vendedor'),
(3,'Veículo');

CREATE TABLE `login` (
	`log_codigo` int NOT NULL AUTO_INCREMENT,
    `log_id` varchar(45) NOT NULL,
    `log_senha` varchar(45) NOT NULL,
    `log_ativo` boolean NOT NULL,
    `usu_tipo` int NOT NULL,
    PRIMARY KEY (`log_codigo`),
    FOREIGN KEY (`usu_tipo`) REFERENCES `usuario`(`usu_tipo`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `login` VALUES
(null, 'cliente_teste', 'd94019fd760a71edf11844bb5c601a4de95aacaf', 1, 1),
(null, 'vendedor_teste','88d6818710e371b461efff33d271e0d2fb6ccf47', 0, 2),
(null, 'vendedor_teste2','88d6818710e371b461efff33d271e0d2fb6ccf47', 1, 2),
(null, 'veiculo_teste', '99a14470de611bd4dc5abea4e7d706e1bce0f9aa', 1, 3),
(null, 'cliente kael', '94fe1b58a75101272a57efa6993f089d0e56d62f', 1, 1),
(null, 'cliente_teste2', 'd94019fd760a71edf11844bb5c601a4de95aacaf', 0, 1);

CREATE TABLE `usuario_cliente` (
  `clt_codigo` int NOT NULL AUTO_INCREMENT,
  `clt_nome` varchar(45) NOT NULL,
  `log_codigo` int NOT NULL,
  PRIMARY KEY (`clt_codigo`),
  FOREIGN KEY (`log_codigo`) REFERENCES `login`(`log_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `usuario_cliente` VALUES
(null, 'TESTE1', 1),
(null, 'Kael', 5),
(null, 'TESTE2', 6);

CREATE TABLE `usuario_vendedor` (
  `ven_codigo` int NOT NULL AUTO_INCREMENT,
  `ven_nome` varchar(45) NOT NULL,
  `log_codigo` int NOT NULL,
  PRIMARY KEY (`ven_codigo`),
  FOREIGN KEY (`log_codigo`) REFERENCES `login`(`log_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `usuario_vendedor` VALUES
(null, 'Wesley', 2),
(null, 'Bezerra', 3);

CREATE TABLE `usuario_veiculo` (
	`vcl_codigo` int NOT NULL AUTO_INCREMENT,
    `log_codigo` int NOT NULL,
    PRIMARY KEY (`vcl_codigo`),
    FOREIGN KEY (`log_codigo`) REFERENCES `login`(`log_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuario_veiculo` VALUES
(1, 3);

CREATE TABLE `veiculo` (
  `vec_codigo` int NOT NULL AUTO_INCREMENT,
  `vec_nome` varchar(45) NOT NULL,
  `vec_marca` varchar(45) NOT NULL,
  `vec_cidade` varchar(45) NOT NULL,
  `vec_estado` varchar(45) NOT NULL,
  `vec_placa` char(7) NOT NULL,
  `vec_pneu` varchar(45) NOT NULL,
  `vec_cor` varchar(45) NOT NULL,
  `vec_motor` varchar(45) NOT NULL,
  PRIMARY KEY (`vec_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `veiculo` VALUES
(null, 'cross', 'toyota', 'guaramirim', 'SP', '77LQ10M', 'bridgestone', 'vermelho escarlate', 'Motor 2.0'),
(null, 'strada', 'fiat', 'balneário camboriu', 'SC', '76EM19K', 'goodyear', 'vermelho perolado', 'Motor 1.6'),
(null, 'toro', 'fiat', 'ituporanga', 'SC', '6LQG66M', 'goodyear', 'verde musgo', 'Motor 1.6'),
(null, 'hb20', 'hyundai', 'juiz de fora', 'MG', '0LQG3MO', 'michelin', 'prata', 'Motor 2.0'),
(null, 'corolla', 'toyota', 'uberlândia', 'MG', '99EGG1', 'goodyear', 'branco perolado', 'Motor 1.8'),
(null, 'uno', 'fiat', 'salvador', 'BH', '777QG0M', 'goodyear', 'amarelo sólido', 'Motor 1.6');

CREATE TABLE `opcao` (
  `opc_codigo` int NOT NULL,
  `opc_descricao` varchar(500) NOT NULL,
  PRIMARY KEY (`opc_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `opcao` VALUES
(1, 'Por dia (se o veículo for devolvido na locadora até ás 15h será cobrado ½ diária)'),
(2, 'Por hora (fração de hora maior que 20 minutos será cobrada hora cheia)'),
(3, 'Por km rodado (fração maior que 400m será cobrado km completo)');

CREATE TABLE `locacao` (
  `loc_codigo` int NOT NULL AUTO_INCREMENT,
  `loc_data` datetime NOT NULL,
  `loc_dias` int NOT NULL,
  `loc_devolvido` boolean NOT NULL,
  `loc_combustivel` int NOT NULL,
  `loc_preco` int NOT NULL,
  `clt_codigo` int NOT NULL,
  `vec_codigo` int NOT NULL,
  `opc_codigo` int NOT NULL,
  PRIMARY KEY (`loc_codigo`),
  FOREIGN KEY (`clt_codigo`) REFERENCES `usuario_cliente`(`clt_codigo`),
  FOREIGN KEY (`opc_codigo`) REFERENCES `opcao`(`opc_codigo`),
  FOREIGN KEY (`vec_codigo`) REFERENCES `veiculo`(`vec_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `locacao` VALUES
(null, '2020-01-01 15:15', 5, 0, 50, 0, 1, 3, 1),
(null, '2020-02-01 15:15', 5, 0, 50, 0, 1, 3, 1),
(null, '2020-03-01 15:15', 5, 0, 50, 0, 1, 3, 1);







