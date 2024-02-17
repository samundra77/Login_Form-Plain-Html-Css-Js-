
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `register` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CodeV` varchar(255) NOT NULL,
  `verification` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `register` (`ID`, `Username`, `email`, `Password`, `CodeV`, `verification`) VALUES
(21, 'Aymane00', 'utchihaitachi@gmail.com', 'e09c80c42fda55f9d992e59ca6b3307d', 'de85810448660823aed64cdfbc767ea0', 1);


ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `register`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

