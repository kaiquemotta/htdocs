CREATE TABLE `pagamento_venda` (
  `ID_Pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `FK_Venda` int(11) NOT NULL,
  `Pagamento` int(11) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Pagamento`),
  KEY `FK_VENDA_Pagamento` (`FK_Venda`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
CREATE TABLE `produto` (
  `ID_Produto` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(500) NOT NULL,
  `Preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Produto`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
CREATE TABLE `venda` (
  `ID_Venda` int(11) NOT NULL AUTO_INCREMENT,
  `DataVenda` datetime NOT NULL,
  `Observacao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_Venda`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;
CREATE TABLE `item_venda` (
  `ID_Item_Venda` int(11) NOT NULL AUTO_INCREMENT,
  `FK_Produto` int(11) NOT NULL,
  `FK_Venda` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  PRIMARY KEY (`ID_Item_Venda`),
  KEY `FK_Produto` (`FK_Produto`),
  KEY `FK_Venda` (`FK_Venda`)
) ENGINE=MyISAM AUTO_INCREMENT=285 DEFAULT CHARSET=latin1;
 
 
 
 