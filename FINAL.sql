-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para tcc
CREATE DATABASE IF NOT EXISTS `tcc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tcc`;

-- Copiando estrutura para tabela tcc.autor
CREATE TABLE IF NOT EXISTS `autor` (
  `idAutor` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL DEFAULT '0',
  `Nacionalidade` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idAutor`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tcc.autor: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela tcc.conta
CREATE TABLE IF NOT EXISTS `conta` (
  `idConta` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `senha` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idConta`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tcc.conta: ~4 rows (aproximadamente)
INSERT INTO `conta` (`idConta`, `nome`, `email`, `senha`) VALUES
	(13, 'Gabriel Alves', 'gabilel2014@gmail.com', 'teste123'),
	(21, 'adm', 'adm@gmail.com', 'adm'),
	(22, 'gabruiel', 'testandoo@gmail.com', 'gnsaubgsja'),
	(24, 'Gabriel Alves', 'gabileal2014@gmail.com', 'senhateste');

-- Copiando estrutura para tabela tcc.editora
CREATE TABLE IF NOT EXISTS `editora` (
  `IdEditora` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdEditora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tcc.editora: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela tcc.favoritos
CREATE TABLE IF NOT EXISTS `favoritos` (
  `idLivro` int(11) DEFAULT NULL,
  `idConta` int(11) DEFAULT NULL,
  `favoritado` int(11) DEFAULT NULL,
  KEY `livros` (`idLivro`),
  KEY `contas` (`idConta`),
  CONSTRAINT `contas` FOREIGN KEY (`idConta`) REFERENCES `conta` (`idConta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tcc.favoritos: ~8 rows (aproximadamente)
INSERT INTO `favoritos` (`idLivro`, `idConta`, `favoritado`) VALUES
	(33, 13, 0),
	(50, 13, 0),
	(25, 13, 0),
	(60, 13, 0),
	(31, NULL, 0),
	(59, NULL, 0),
	(39, NULL, 1),
	(75, NULL, 1);

-- Copiando estrutura para tabela tcc.genero
CREATE TABLE IF NOT EXISTS `genero` (
  `genero` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `idlivro` int(11) DEFAULT NULL,
  PRIMARY KEY (`genero`),
  KEY `livro` (`idlivro`),
  CONSTRAINT `livro` FOREIGN KEY (`idlivro`) REFERENCES `livro` (`idLivro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tcc.genero: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela tcc.livro
CREATE TABLE IF NOT EXISTS `livro` (
  `idLivro` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `AnoLanc` int(11) DEFAULT NULL,
  `Edicao` varchar(5) DEFAULT NULL,
  `Serie` varchar(100) DEFAULT 'Desconhecido',
  `Genero` varchar(100) NOT NULL DEFAULT 'Desconhecido',
  `Editora` varchar(100) DEFAULT NULL,
  `Autor` varchar(50) DEFAULT 'Desconhecido',
  `img` varchar(250) DEFAULT NULL,
  `Leitor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idLivro`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tcc.livro: ~54 rows (aproximadamente)
INSERT INTO `livro` (`idLivro`, `Nome`, `AnoLanc`, `Edicao`, `Serie`, `Genero`, `Editora`, `Autor`, `img`, `Leitor`) VALUES
	(19, 'O Vento nos Salgueiros', 1908, NULL, 'O Vento nos Salgueiros', 'Infantil', NULL, 'Kenneth Grahame', '../Imagens/Capas/O Vento nos Salgueiros.jpg', NULL),
	(20, 'Ursinho Pooh', 1926, NULL, 'Ursinho Pooh', 'Infantil', NULL, 'Alan Alexander Milne', '../Imagens/Capas/Ursinho Pooh.jpg', NULL),
	(21, 'O Livro da Selva', 1894, NULL, 'O Livro da Selva', 'Infantil', NULL, 'Rudyard Kipling', '../Imagens/Capas/O Livro da Selva.jpg', NULL),
	(22, 'Peter Pan', 1911, NULL, 'Peter Pan', 'Infantil', NULL, 'J.M. Barrie', '../Imagens/Capas/Peter Pan.jpg', NULL),
	(23, 'Pinóquio', 1883, NULL, 'Pinóquio', 'Infantil', NULL, 'Carlo Collodi', '../Imagens/Capas/Pinóquio.jpg', NULL),
	(24, 'As Aventuras de Tom Sawyer', 1876, NULL, NULL, 'Infantil', NULL, 'Mark Twain', '../Imagens/Capas/As Aventuras de Tom Sawyer.jpg', NULL),
	(25, 'Heidi', 1880, NULL, 'Heidi', 'Infantil', NULL, ' Johanna Spyri', '../Imagens/Capas/Heidi.jpg', NULL),
	(26, 'O Maravilhoso Mágico de Oz', 1900, NULL, 'Oz', 'Infantil', NULL, 'L. Frank Baum', '../Imagens/Capas/O Maravilhoso Mágico de Oz.jpg', NULL),
	(27, 'Pollyanna', 1913, NULL, 'Pollyanna', 'Infantil', NULL, 'Eleanor H. Porter', '../Imagens/Capas/Pollyanna.jpg', NULL),
	(28, 'Os Contos de Andersen', 1835, NULL, NULL, 'Infantil', NULL, 'Hans Christian Andersen', '../Imagens/Capas/Os Contos de Andersen.jpg', NULL),
	(29, 'O Assassinato de Roger Ackroyd', 1926, NULL, 'Hercule Poirot', 'Suspense', NULL, 'Agatha Christie', '../Imagens/Capas/O Assassinato de Roger Ackroyd.jpg', NULL),
	(30, 'Drácula', 1897, NULL, NULL, 'Suspense', NULL, 'Bram Stoker', '../Imagens/Capas/Drácula.jpg', NULL),
	(31, 'O Fantasma da Ópera', 1909, NULL, NULL, 'Suspense', NULL, 'Gaston Leroux', '../Imagens/Capas/O Fantasma da Ópera.jpg', NULL),
	(32, 'O Homem Invisível', 1897, NULL, NULL, 'Suspense', NULL, 'H.G. Wells', '../Imagens/Capas/O Homem Invisível.jpg', NULL),
	(33, 'A Volta ao Mundo em 80 Dias', 1873, NULL, NULL, 'Suspense', NULL, 'Júlio Verne', '../Imagens/Capas/A Volta ao Mundo em 80 Dias.jpg', NULL),
	(34, 'Os Trabalhadores do Mar', 1866, NULL, NULL, 'Suspense', NULL, 'Victor Hugo', '../Imagens/Capas/Os Trabalhadores do Mar.jpg', NULL),
	(36, 'O Duplo', 1846, NULL, NULL, 'Suspense', NULL, 'Fiódor Dostoiévski', '../Imagens/Capas/O Duplo.jpg', NULL),
	(37, 'Mysteries', 1892, NULL, NULL, 'Suspense', NULL, 'Knut Hamsun ', '../Imagens/Capas/Mysteries.jpg', NULL),
	(38, 'Jane Eyre', 1847, NULL, NULL, 'Romance', NULL, 'Charlotte Brontë', '../Imagens/Capas/Jane Eyre.jpg', NULL),
	(39, 'Dom Casmurro', 1899, NULL, NULL, 'Romance', NULL, 'Machado de Assis', '../Imagens/Capas/Dom Casmurro.jpg', NULL),
	(40, 'Orgulho e Preconceito', 1813, NULL, NULL, 'Romance', NULL, 'Jane Austen', '../Imagens/Capas/Orgulho e Preconceito.jpg', NULL),
	(41, 'Anna Karenina', 1877, NULL, NULL, 'Romance', NULL, 'Lev Tolstói', '../Imagens/Capas/Anna Karenina.jpg', NULL),
	(42, 'Razão e Sensibilidade', 1811, NULL, NULL, 'Romance', NULL, 'Jane Austen', '../Imagens/Capas/Razão e Sensibilidade.jpg', NULL),
	(43, 'Mansfield Park', 1814, NULL, NULL, 'Romance', NULL, 'Jane Austen ', '../Imagens/Capas/Mansfield Park.jpg', NULL),
	(44, 'Os Sofrimentos do Jovem Werther', 1774, NULL, NULL, 'Romance', NULL, 'Johann Wolfgang von Goethe', '../Imagens/Capas/Os Sofrimentos do Jovem Werther.jpg', NULL),
	(45, 'Persuasão', 1818, NULL, NULL, 'Romance', NULL, 'Jane Austen', '../Imagens/Capas/Persuasão.jpg', NULL),
	(46, 'Grandes Esperanças', 1861, NULL, NULL, 'Romance', NULL, ' Charles Dickens', '../Imagens/Capas/Grandes Esperanças.jpg', NULL),
	(47, 'Alice no País das Maravilhas', 1865, NULL, NULL, 'Fantasia', NULL, 'Lewis Carroll ', '../Imagens/Capas/Alice no País das Maravilhas.jpg', 'livros/Alice/epubjs-reader-master/reader/index.html'),
	(48, 'As Crônicas de Nárnia', 1950, NULL, 'As Crônicas de Nárnia', 'Fantasia', NULL, 'C.S. Lewis', '../Imagens/Capas/As Crônicas de Nárnia.jpg', NULL),
	(49, 'A Princesa e o Goblin', 1872, NULL, 'Princesa Irene', 'Fantasia', NULL, 'George MacDonald', '../Imagens/Capas/A Princesa e o Goblin.jpg', NULL),
	(52, 'O Hobbit', 1937, NULL, NULL, 'Fantasia', NULL, 'J.R.R. Tolkien', '../Imagens/Capas/O Hobbit.jpg', NULL),
	(53, 'Os Irmãos Grimm', 1812, NULL, 'Contos de Fadas', 'Fantasia', NULL, 'Jacob e Wilhelm Grimm', '../Imagens/Capas/Os Irmãos Grimm.jpg', NULL),
	(56, 'Lilith', 1895, NULL, NULL, 'Fantasia', NULL, 'George MacDonald', '../Imagens/Capas/Lilith.jpg', NULL),
	(57, 'Moby Dick', 1851, NULL, NULL, 'Romance', NULL, 'Herman Melville', '../Imagens/Capas/Moby Dick.jpg', 'livros/MobyDick/epubjs-reader-master/reader/index.html'),
	(58, 'Os Três Mosqueteiros', 1844, NULL, 'Os Três Mosqueteiros', 'Ação', NULL, 'Alexandre Dumas', '../Imagens/Capas/Os Três Mosqueteiros.jpg', NULL),
	(59, 'O Conde de Monte Cristo', 1844, NULL, 'O Conde de Monte Cristo', 'Ação', NULL, 'Alexandre Dumas', '../Imagens/Capas/O Conde de Monte Cristo.jpg', NULL),
	(60, 'O Corcunda de Notre-Dame', 1831, NULL, NULL, 'Ação', NULL, 'Victor Hugo', '../Imagens/Capas/O Corcunda de Notre-Dame.jpg', NULL),
	(61, 'As Minas do Rei Salomão', 1855, NULL, NULL, 'Ação', NULL, 'H. Rider Haggard', '../Imagens/Capas/As Minas do Rei Salomão.jpg', NULL),
	(62, 'Vinte Mil Léguas Submarinas', 1870, NULL, 'Desconhecido', 'Ação', NULL, ' Júlio Verne', '../Imagens/Capas/Vinte Mil Léguas Submarinas.jpg', NULL),
	(63, 'A Ilha do Tesouro', 1883, NULL, 'Desconhecido', 'Ação', NULL, 'Robert Louis Stevenson', '../Imagens/Capas/A Ilha do Tesouro.jpg', NULL),
	(64, 'Ben-Hur', 1880, NULL, 'Desconhecido', 'Ação', NULL, 'Lewis Wallace', '../Imagens/Capas/Ben-Hur.jpg', NULL),
	(65, 'O Lobo do Mar', 1904, NULL, 'Desconhecido', 'Ação', NULL, 'Jack London', '../Imagens/Capas/O Lobo do Mar.jpg', NULL),
	(66, 'A Divina Comédia', 1472, NULL, 'A Divina Comédia', 'Ação', NULL, 'Dante Alighieri', '../Imagens/Capas/A Divina Comedia.jpg', NULL),
	(67, 'A Igreja do Diabo', 1884, NULL, 'Desconhecido', 'Ação', NULL, 'Machado de Assis', '../Imagens/Capas/A Igreja do Diabo.jpg', NULL),
	(68, 'Como Fazer Amigos e Influenciar Pessoas', 1936, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Dale Carnegie', '../Imagens/Capas/Como Fazer Amigos e Influenciar Pessoas.jpg', NULL),
	(69, 'O Poder do Pensamento Positivo', 1952, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Norman Vincent Peale', '../Imagens/Capas/O Poder do Pensamento Positivo.jpg', NULL),
	(70, 'Como Evitar Preocupações e Começar a Viver', 1981, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'L. Ron Hubbard', '../Imagens/Capas/Como Evitar Preocupações e Começar a Viver.jpg', NULL),
	(71, 'A Arte de Viver', NULL, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Epicteto', '../Imagens/Capas/A Arte de Viver.jpg', NULL),
	(72, 'Meditações', 170, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Marcos Aurélio', '../Imagens/Capas/Meditações.jpg', NULL),
	(73, 'Livro da Vida', NULL, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Santa Teresa de Ávila', '../Imagens/Capas/Livro da Vida.jpg', NULL),
	(74, 'O Livro dos Espíritos', 1857, NULL, 'Obras espíritas', 'Auto Ajuda', NULL, 'Allan Kardec', '../Imagens/Capas/O Livro dos Espíritos.jpg', NULL),
	(75, 'O Poder do Silêncio', 1987, NULL, 'Os Ensinamentos de Dom Juan.', 'Auto Ajuda', NULL, 'Carlos Castaneda', '../Imagens/Capas/O Poder do Silêncio.jpg', NULL),
	(76, 'O Livro do Desassossego', 1982, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Fernando Pessoa', '../Imagens/Capas/O Livro do Desassossego.jpg', NULL),
	(77, 'O Livro do Eclesiastes', -2000, NULL, 'Desconhecido', 'Auto Ajuda', NULL, 'Salomão', '../Imagens/Capas/O Livro do Eclesiastes.jpg', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
