-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 09:32 PM
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
-- Database: `lmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CrsId` int(11) NOT NULL,
  `CrsName` varchar(50) NOT NULL,
  `FacultyId` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CrsId`, `CrsName`, `FacultyId`, `Description`) VALUES
(4, 'Database', 27, 'Database Course'),
(5, 'Computer Science', 12, 'Computer Science'),
(11, 'Network', 13, 'Network'),
(15, 'AI', 12, 'artificial intelligence'),
(19, 'IT', 12, 'Internet Technology');

-- --------------------------------------------------------

--
-- Table structure for table `courseregisteration`
--

CREATE TABLE `courseregisteration` (
  `CrsId` int(11) NOT NULL,
  `StuId` int(11) NOT NULL,
  `Grade` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courseregisteration`
--

INSERT INTO `courseregisteration` (`CrsId`, `StuId`, `Grade`) VALUES
(4, 3, NULL),
(5, 3, NULL),
(11, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursevideos`
--

CREATE TABLE `coursevideos` (
  `VideoId` int(11) NOT NULL,
  `VideoPath` varchar(255) NOT NULL,
  `CrsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursevideos`
--

INSERT INTO `coursevideos` (`VideoId`, `VideoPath`, `CrsId`) VALUES
(1, '../../../Videos/GNS3 Tutorial (6)_ DHCP Configuration Lab [Step-by-Step].mp4', 11),
(2, '../../../Videos/UML Diagrams - Package Diagram.mp4', 5);

-- --------------------------------------------------------

--
-- Table structure for table `evalquestion`
--

CREATE TABLE `evalquestion` (
  `QuestionId` int(11) NOT NULL,
  `Text` varchar(255) NOT NULL,
  `questionnaireId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `EvaluationId` int(11) NOT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `Date` datetime NOT NULL,
  `evaluator_id` int(11) NOT NULL,
  `QuestionnaireId` int(11) NOT NULL,
  `evaluatee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `ExamId` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `CrsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facultymember`
--

CREATE TABLE `facultymember` (
  `UserId` int(11) NOT NULL,
  `SsNo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facultymember`
--

INSERT INTO `facultymember` (`UserId`, `SsNo`) VALUES
(12, '3040278937925'),
(13, '3030987750254'),
(27, '3020810948304345'),
(33, '309019038052542');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotifId` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `IsRead` tinyint(1) NOT NULL DEFAULT 0,
  `DateSent` datetime NOT NULL,
  `ReceiverId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `QuestionnaireId` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionresponse`
--

CREATE TABLE `questionresponse` (
  `ResponseId` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `ResponseText` varchar(255) NOT NULL,
  `evaluationId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `QuestionId` int(11) NOT NULL,
  `Text` varchar(255) NOT NULL,
  `CorrectAnswer` varchar(255) NOT NULL,
  `ExamId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `SchId` int(11) NOT NULL,
  `EventType` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `CrsId` int(11) NOT NULL,
  `FactulyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `UserId` int(11) NOT NULL,
  `Age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`UserId`, `Age`) VALUES
(3, 20),
(20, 18),
(28, 21);

-- --------------------------------------------------------

--
-- Table structure for table `studentanswer`
--

CREATE TABLE `studentanswer` (
  `AnswerId` int(11) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `IsCorrect` tinyint(1) NOT NULL,
  `QuestionId` int(11) NOT NULL,
  `ExamId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RoleName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `UserName`, `Password`, `Email`, `RoleName`) VALUES
(1, 'adminone', 'admin1', 'Admin123', 'admin1@gmail.com', 'Admin'),
(3, 'studenttwo', 'student2', 'Student234', 'student2@gmail.com', 'Student'),
(6, 'admintwo', 'admin2', 'Admin234', 'admintwo@gmail.com', 'Admin'),
(12, 'membertwo', 'member2', 'Member234', 'member2@gmail.com', 'Faculty'),
(13, 'memberthree', 'member3', 'Member345', 'memberthree@gmail.com', 'Faculty'),
(20, 'Studentthree', 'student3', 'Student345', 'Student3@gmaill.com', 'Student'),
(27, 'memberone', 'member1', 'Member123', 'member1@gmail.com', 'Faculty'),
(28, 'Student1', 'student1', 'Student123', 'Student1@gmail.com', 'Student'),
(32, 'adminthree', 'admin3', 'Admin345', 'adminthree3@gmail.com', 'Admin'),
(33, 'memberfour', 'member4', 'Member456', 'member4@gmail.com', 'Faculty');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CrsId`),
  ADD KEY `FacultyId` (`FacultyId`);

--
-- Indexes for table `courseregisteration`
--
ALTER TABLE `courseregisteration`
  ADD PRIMARY KEY (`CrsId`,`StuId`),
  ADD KEY `courseregisteration_ibfk_1` (`StuId`);

--
-- Indexes for table `coursevideos`
--
ALTER TABLE `coursevideos`
  ADD PRIMARY KEY (`VideoId`),
  ADD KEY `CrsId` (`CrsId`);

--
-- Indexes for table `evalquestion`
--
ALTER TABLE `evalquestion`
  ADD PRIMARY KEY (`QuestionId`),
  ADD KEY `questionnaireId` (`questionnaireId`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`EvaluationId`),
  ADD KEY `evaluatee_id` (`evaluatee_id`),
  ADD KEY `evaluator_id` (`evaluator_id`),
  ADD KEY `QuestionnaireId` (`QuestionnaireId`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`ExamId`),
  ADD KEY `CrsId` (`CrsId`);

--
-- Indexes for table `facultymember`
--
ALTER TABLE `facultymember`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotifId`),
  ADD KEY `ReceiverId` (`ReceiverId`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`QuestionnaireId`);

--
-- Indexes for table `questionresponse`
--
ALTER TABLE `questionresponse`
  ADD PRIMARY KEY (`ResponseId`),
  ADD KEY `questionresponse_ibfk_1` (`evaluationId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`QuestionId`),
  ADD KEY `ExamId` (`ExamId`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`SchId`),
  ADD KEY `CrsId` (`CrsId`),
  ADD KEY `FactulyId` (`FactulyId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `studentanswer`
--
ALTER TABLE `studentanswer`
  ADD PRIMARY KEY (`AnswerId`),
  ADD KEY `QuestionId` (`QuestionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `CrsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `coursevideos`
--
ALTER TABLE `coursevideos`
  MODIFY `VideoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evalquestion`
--
ALTER TABLE `evalquestion`
  MODIFY `QuestionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `EvaluationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `ExamId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facultymember`
--
ALTER TABLE `facultymember`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotifId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `QuestionnaireId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questionresponse`
--
ALTER TABLE `questionresponse`
  MODIFY `ResponseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `QuestionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `SchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`FacultyId`) REFERENCES `facultymember` (`UserId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `courseregisteration`
--
ALTER TABLE `courseregisteration`
  ADD CONSTRAINT `courseregisteration_ibfk_1` FOREIGN KEY (`StuId`) REFERENCES `student` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courseregisteration_ibfk_2` FOREIGN KEY (`CrsId`) REFERENCES `course` (`CrsId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursevideos`
--
ALTER TABLE `coursevideos`
  ADD CONSTRAINT `coursevideos_ibfk_1` FOREIGN KEY (`CrsId`) REFERENCES `course` (`CrsId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evalquestion`
--
ALTER TABLE `evalquestion`
  ADD CONSTRAINT `evalquestion_ibfk_1` FOREIGN KEY (`questionnaireId`) REFERENCES `questionnaire` (`QuestionnaireId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`evaluatee_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`evaluator_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_ibfk_3` FOREIGN KEY (`QuestionnaireId`) REFERENCES `questionnaire` (`QuestionnaireId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`CrsId`) REFERENCES `course` (`CrsId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facultymember`
--
ALTER TABLE `facultymember`
  ADD CONSTRAINT `facultymember_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`ReceiverId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionresponse`
--
ALTER TABLE `questionresponse`
  ADD CONSTRAINT `questionresponse_ibfk_1` FOREIGN KEY (`evaluationId`) REFERENCES `evaluation` (`EvaluationId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionresponse_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `evalquestion` (`QuestionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`ExamId`) REFERENCES `exam` (`ExamId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`CrsId`) REFERENCES `course` (`CrsId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`FactulyId`) REFERENCES `facultymember` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentanswer`
--
ALTER TABLE `studentanswer`
  ADD CONSTRAINT `studentanswer_ibfk_1` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`QuestionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentanswer_ibfk_2` FOREIGN KEY (`AnswerId`) REFERENCES `exam` (`ExamId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
