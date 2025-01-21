-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 11:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketbooth`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `Movie_ID` int(11) NOT NULL,
  `Movie_Name` varchar(50) DEFAULT NULL,
  `Movie_Description` varchar(1000) DEFAULT NULL,
  `Movie_Trailer` varchar(255) DEFAULT NULL,
  `Movie_Poster` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`Movie_ID`, `Movie_Name`, `Movie_Description`, `Movie_Trailer`, `Movie_Poster`) VALUES
(1, 'Forrest Gump', 'The history of the United States from the 1950s to the \'70s unfolds from the perspective of an Alabama man with an IQ of 75, who yearns to be reunited with his childhood sweetheart.', 'https://www.youtube.com/watch?v=Mj9IA9tTfio&ab_channel=ParamountMovies', 'Posters\\Forrest Gump.jpg'),
(2, 'Grave of the Fireflies', 'A young boy and his little sister struggle to survive in Japan during World War II.', 'https://www.youtube.com/watch?v=4vPeTSRd580&ab_channel=CrunchyrollStoreAustralia', 'Posters\\Grave of the fireflies.jpg'),
(3, 'Green Book', 'A working-class Italian-American bouncer becomes the driver for an African-American classical pianist on a tour of venues through the 1960s American South.', 'https://www.youtube.com/watch?v=QkZxoko_HC0&ab_channel=UniversalPictures', 'Posters\\Green Book.jpg'),
(4, 'Inception', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.', 'https://www.youtube.com/watch?v=YoHD9XEInc0&ab_channel=RottenTomatoesClassicTrailers', 'Posters\\Inception.jpg'),
(5, 'Interstellar', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.', 'https://www.youtube.com/watch?v=2LqzF5WauAw&ab_channel=InterstellarMovie', 'Posters\\Interstellar.jpg'),
(6, 'Joker', 'Arthur Fleck, a party clown and a failed stand-up comedian, leads an impoverished life with his ailing mother. However, when society shuns him and brands him as a freak, he decides to embrace the life of chaos in Gotham City.', 'https://www.youtube.com/watch?v=zAGVQLHvwOY&ab_channel=WarnerBros.Pictures', 'Posters\\Joker.jpg'),
(7, 'Oppenheimer', 'A dramatization of the life story of J. Robert Oppenheimer, the physicist who had a large hand in the development of the atomic bombs that brought an end to World War II.', 'https://www.youtube.com/watch?v=uYPbbksJxIg&ab_channel=UniversalPictures', 'Posters\\Oppenheimer.jpg'),
(8, 'Spider-Man: Into the Spider-Verse', 'Teen Miles Morales becomes the Spider-Man of his universe and must join with five spider-powered individuals from other dimensions to stop a threat for all realities.', 'https://www.youtube.com/watch?v=g4Hbz2jLxvQ&t=1s&ab_channel=SonyPicturesEntertainment', 'Posters\\Spider Man .jpg'),
(9, 'Spirited Away', 'During her family\'s move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches and spirits, and where humans are changed into beasts.', 'https://www.youtube.com/watch?v=ByXuk9QqQkk&ab_channel=CrunchyrollStoreAustralia', 'Posters\\Spirited Away.jpg'),
(10, 'The Dark Knight', 'When a menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman, James Gordon and Harvey Dent must work together to put an end to the madness.', 'https://www.youtube.com/watch?v=EXeTwQWrcwY&t=4s&ab_channel=RottenTomatoesClassicTrailers', 'Posters\\The Dark Knight.jpg'),
(11, 'The Green Mile', 'Paul Edgecomb, the head death row guard at a prison in 1930s Louisiana, meets an inmate, John Coffey, a black man who is accused of murdering two girls. His life changes drastically when he discovers that John has a special gift.', 'https://www.youtube.com/watch?v=Ki4haFrqSrw&ab_channel=RottenTomatoesClassicTrailers', 'Posters\\The Green Mile.jpg'),
(12, 'Fight Club', 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.', 'https://www.youtube.com/watch?v=O1nDozs-LxI&ab_channel=FilmFeed', 'Posters\\Fight Club.jpg'),
(13, 'Top Gun: Maverick', 'The story involves Maverick confronting his past while training a group of younger Top Gun graduates, including the son of his deceased best friend, for a dangerous mission.', 'https://www.youtube.com/watch?v=qSqVVswa420&ab_channel=ParamountPictures', 'Posters\\Top Gun.jpg'),
(14, 'Your Name', 'Two teenagers share a profound, magical connection upon discovering they are swapping bodies. Things manage to become even more complicated when the boy and girl decide to meet in person.', 'https://www.youtube.com/watch?v=NooIc3dMncc&ab_channel=ConvincingAnimeTrailers', 'Posters\\Your Name.jpg'),
(15, 'Avengers: Infinity War', 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.', 'https://www.youtube.com/watch?v=TcMBFSGVi1c&ab_channel=MarvelEntertainment', 'Posters\\Avengers.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`Movie_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `Movie_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
