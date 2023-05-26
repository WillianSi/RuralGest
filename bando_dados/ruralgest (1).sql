SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Banco de dados: `ruralgest`

-- --------------------------------------------------------

-- Estrutura da tabela `financas`

CREATE TABLE `financas` (
  `cod` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `data_servico` date NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `nota_fiscal` longblob NOT NULL,
  `cod_servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estrutura da tabela `servicos`

CREATE TABLE `servicos` (
  `cod` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Extraindo dados da tabela `servicos`

INSERT INTO `servicos` (`cod`, `nome`, `data`) VALUES
(1, 'planta de morango', '2023-05-16');

-- --------------------------------------------------------

-- Estrutura da tabela `usuario`

CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `perfil` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Extraindo dados da tabela `usuario`

INSERT INTO `usuario` (`cod`, `nome`, `senha`, `email`, `perfil`, `status`, `data`) VALUES
(25, 'Fábio Junior Alves', '202cb962ac59075b964b07152d234b70', 'faguanil@gmail.com', 1, 1, '2023-05-20'),
(29, 'ddsdd', '202cb962ac59075b964b07152d234b70', 'fff@gmail.com', 1, 1, '2023-05-15'),
(30, 'teste', '202cb962ac59075b964b07152d234b70', 'teste1@gmail.com', 0, 0, '0000-00-00'),
(31, 'teste', '202cb962ac59075b964b07152d234b70', 'teste@gmail.com', 1, 1, '2023-05-20'),
(32, 'ssss', 'c4ca4238a0b923820dcc509a6f75849b', 'fffeee@gmail.com', 1, 1, '2023-05-20'),
(33, 'ssss', '6512bd43d9caa6e02c990b0a82652dca', 'faguan23il@gmail.com', 1, 1, '2023-05-20'),
(34, 'ddsdd', 'c4ca4238a0b923820dcc509a6f75849b', 'daniloewwe@gmail.com', 1, 1, '2023-05-20'),
(35, 'ddsdd', 'c4ca4238a0b923820dcc509a6f75849b', 'dansas@gmail.com', 1, 1, '2023-05-20'),
(36, 'teste', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'fl@gmail.com', 1, 1, '2023-05-20');

-- Índices para tabelas despejadas

-- Índices para tabela `financas`
ALTER TABLE `financas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `foreign_key_cod_servico` (`cod_servico`);

-- Índices para tabela `servicos`
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`cod`);

-- Índices para tabela `usuario`
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`);

-- AUTO_INCREMENT de tabelas despejadas

-- AUTO_INCREMENT de tabela `financas`
ALTER TABLE `financas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- AUTO_INCREMENT de tabela `servicos`
ALTER TABLE `servicos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT de tabela `usuario`
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

-- Limitadores para a tabela `financas`
ALTER TABLE `financas`
  ADD CONSTRAINT `foreign_key_cod_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
