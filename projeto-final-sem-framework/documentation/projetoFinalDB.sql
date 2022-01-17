-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18-Jan-2022 às 00:29
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetoFinalDB`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Categoria`
--

CREATE TABLE `Categoria` (
  `codcategoria` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cidade`
--

CREATE TABLE `Cidade` (
  `codcidade` int(11) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `Entrada`
--

CREATE TABLE `Entrada` (
  `codentrada` int(11) NOT NULL,
  `Transportadora_codtransportadora` int(11) NOT NULL,
  `dataped` date NOT NULL,
  `dataentr` date NOT NULL,
  `total` double NOT NULL,
  `frete` double NOT NULL,
  `numnf` int(11) NOT NULL,
  `imposto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Fornecedor`
--

CREATE TABLE `Fornecedor` (
  `codfornecedor` int(11) NOT NULL,
  `Cidade_codcidade` int(11) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` char(9) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `insc` varchar(255) NOT NULL,
  `tel` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `ItemEntrada`
--

CREATE TABLE `ItemEntrada` (
  `coditementrada` int(11) NOT NULL,
  `Produto_codproduto` int(11) NOT NULL,
  `Entrada_codentrada` int(11) NOT NULL,
  `lote` varchar(255) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ItemSaida`
--

CREATE TABLE `ItemSaida` (
  `coditemsaida` int(11) NOT NULL,
  `Saida_codsaida` int(11) NOT NULL,
  `Produto_codproduto` int(11) NOT NULL,
  `lote` varchar(255) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Loja`
--

CREATE TABLE `Loja` (
  `codloja` int(11) NOT NULL,
  `Cidade_codcidade` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `tel` char(14) NOT NULL,
  `insc` varchar(255) NOT NULL,
  `cnpj` char(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estrutura da tabela `Produto`
--

CREATE TABLE `Produto` (
  `codproduto` int(11) NOT NULL,
  `Categoria_codcategoria` int(11) NOT NULL,
  `Fornecedor_codfornecedor` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `peso` double NOT NULL,
  `controlado` tinyint(1) NOT NULL,
  `qtdemin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estrutura da tabela `Saida`
--

CREATE TABLE `Saida` (
  `codsaida` int(11) NOT NULL,
  `Loja_codloja` int(11) NOT NULL,
  `Transportadora_codtransportadora` int(11) NOT NULL,
  `total` double NOT NULL,
  `frete` double NOT NULL,
  `imposto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Transportadora`
--

CREATE TABLE `Transportadora` (
  `codtransportadora` int(11) NOT NULL,
  `Cidade_codcidade` int(11) NOT NULL,
  `transportadora` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` char(9) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `insc` varchar(255) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `tel` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`codcategoria`),
  ADD KEY `codcategoria` (`codcategoria`);

--
-- Índices para tabela `Cidade`
--
ALTER TABLE `Cidade`
  ADD PRIMARY KEY (`codcidade`);

--
-- Índices para tabela `Entrada`
--
ALTER TABLE `Entrada`
  ADD PRIMARY KEY (`codentrada`),
  ADD KEY `Transportadora_codtransportadora` (`Transportadora_codtransportadora`);

--
-- Índices para tabela `Fornecedor`
--
ALTER TABLE `Fornecedor`
  ADD PRIMARY KEY (`codfornecedor`),
  ADD KEY `Cidade_codcidade` (`Cidade_codcidade`);

--
-- Índices para tabela `ItemEntrada`
--
ALTER TABLE `ItemEntrada`
  ADD PRIMARY KEY (`coditementrada`),
  ADD KEY `Produto_codproduto` (`Produto_codproduto`),
  ADD KEY `Entrada_codentrada` (`Entrada_codentrada`);

--
-- Índices para tabela `ItemSaida`
--
ALTER TABLE `ItemSaida`
  ADD PRIMARY KEY (`coditemsaida`),
  ADD KEY `Saida_codsaida` (`Saida_codsaida`),
  ADD KEY `Produto_codproduto` (`Produto_codproduto`);

--
-- Índices para tabela `Loja`
--
ALTER TABLE `Loja`
  ADD PRIMARY KEY (`codloja`),
  ADD KEY `Cidade_codcidade` (`Cidade_codcidade`);

--
-- Índices para tabela `Produto`
--
ALTER TABLE `Produto`
  ADD PRIMARY KEY (`codproduto`),
  ADD KEY `Categoria_codcategoria` (`Categoria_codcategoria`),
  ADD KEY `Fornecedor_codfornecedor` (`Fornecedor_codfornecedor`);

--
-- Índices para tabela `Saida`
--
ALTER TABLE `Saida`
  ADD PRIMARY KEY (`codsaida`),
  ADD KEY `Loja_codloja` (`Loja_codloja`),
  ADD KEY `Transportadora_codtransportadora` (`Transportadora_codtransportadora`);

--
-- Índices para tabela `Transportadora`
--
ALTER TABLE `Transportadora`
  ADD PRIMARY KEY (`codtransportadora`),
  ADD KEY `Cidade_codcidade` (`Cidade_codcidade`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `codcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `Cidade`
--
ALTER TABLE `Cidade`
  MODIFY `codcidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `Entrada`
--
ALTER TABLE `Entrada`
  MODIFY `codentrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Fornecedor`
--
ALTER TABLE `Fornecedor`
  MODIFY `codfornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ItemEntrada`
--
ALTER TABLE `ItemEntrada`
  MODIFY `coditementrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ItemSaida`
--
ALTER TABLE `ItemSaida`
  MODIFY `coditemsaida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Loja`
--
ALTER TABLE `Loja`
  MODIFY `codloja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `Produto`
--
ALTER TABLE `Produto`
  MODIFY `codproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `Saida`
--
ALTER TABLE `Saida`
  MODIFY `codsaida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Transportadora`
--
ALTER TABLE `Transportadora`
  MODIFY `codtransportadora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `Entrada`
--
ALTER TABLE `Entrada`
  ADD CONSTRAINT `Entrada_ibfk_1` FOREIGN KEY (`Transportadora_codtransportadora`) REFERENCES `Transportadora` (`codtransportadora`);

--
-- Limitadores para a tabela `Fornecedor`
--
ALTER TABLE `Fornecedor`
  ADD CONSTRAINT `Fornecedor_ibfk_1` FOREIGN KEY (`Cidade_codcidade`) REFERENCES `Cidade` (`codcidade`);

--
-- Limitadores para a tabela `ItemEntrada`
--
ALTER TABLE `ItemEntrada`
  ADD CONSTRAINT `ItemEntrada_ibfk_1` FOREIGN KEY (`Produto_codproduto`) REFERENCES `Produto` (`codproduto`),
  ADD CONSTRAINT `ItemEntrada_ibfk_2` FOREIGN KEY (`Entrada_codentrada`) REFERENCES `Entrada` (`codentrada`);

--
-- Limitadores para a tabela `ItemSaida`
--
ALTER TABLE `ItemSaida`
  ADD CONSTRAINT `ItemSaida_ibfk_1` FOREIGN KEY (`Produto_codproduto`) REFERENCES `Produto` (`codproduto`),
  ADD CONSTRAINT `ItemSaida_ibfk_2` FOREIGN KEY (`Saida_codsaida`) REFERENCES `Saida` (`codsaida`);

--
-- Limitadores para a tabela `Loja`
--
ALTER TABLE `Loja`
  ADD CONSTRAINT `Loja_ibfk_1` FOREIGN KEY (`Cidade_codcidade`) REFERENCES `Cidade` (`codcidade`);

--
-- Limitadores para a tabela `Produto`
--
ALTER TABLE `Produto`
  ADD CONSTRAINT `Produto_ibfk_1` FOREIGN KEY (`Categoria_codcategoria`) REFERENCES `Categoria` (`codcategoria`),
  ADD CONSTRAINT `Produto_ibfk_2` FOREIGN KEY (`Fornecedor_codfornecedor`) REFERENCES `Fornecedor` (`codfornecedor`);

--
-- Limitadores para a tabela `Saida`
--
ALTER TABLE `Saida`
  ADD CONSTRAINT `Saida_ibfk_1` FOREIGN KEY (`Loja_codloja`) REFERENCES `Loja` (`codloja`),
  ADD CONSTRAINT `Saida_ibfk_2` FOREIGN KEY (`Transportadora_codtransportadora`) REFERENCES `Transportadora` (`codtransportadora`);

--
-- Limitadores para a tabela `Transportadora`
--
ALTER TABLE `Transportadora`
  ADD CONSTRAINT `Transportadora_ibfk_1` FOREIGN KEY (`Cidade_codcidade`) REFERENCES `Cidade` (`codcidade`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
