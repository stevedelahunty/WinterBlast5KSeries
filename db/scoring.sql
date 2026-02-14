
insert into series (name) values ('BringOnTheHeat 2026');
SET @last_series_id = LAST_INSERT_ID();
select @last_series_id;

CREATE TABLE `series_events` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `source` varchar(64),
  `seriesId` int(4),
  `eventId` int(4),
  `raceId` int(4),
  `raceNumber` int(4),
  `raceName` varchar(128),
  `displayName` varchar(128) default '',
  `resultsLink` varchar(512) default '',
  `raceDate` datetime,
  `resultsSetName` varchar(128),
  `maxPoints` int(4),
  `alg` varchar(32),
  `ownerId` int(4),
  `created` datetime,
  `lastUpdate` datetime,
  `needsUpdate` int(1),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName, displayName, resultsLink, raceDate, resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '173357', '915308', 1, 'Fit for the Holidays - 1 Miler', 'Fit for the Holidays', '', '', '', 1000, "entered");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName, displayName, resultsLink,  raceDate, resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '173357', '915313', 1, 'Fit for the Holidays - 5K', 'Fit for the Holidays', '', '', '', 1000, "entered");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName, displayName, resultsLink,  raceDate, resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '173357', '915660', 1, 'Fit for the Holidays - 30 Min', 'Fit for the Holidays', '', '', '', 1000, "entered");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName,  raceDate, resultsLink,  resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '138320', '897807', 2, 'NH Corn Hole Biathlon Race 2.5 Miler', 
  '2025-11-30', 
  'https://runsignup.com/Race/Results/138320#resultSetId-612898', 'NH Corn Hole Biathlon 2.5 miler Overall Results', 1000, "place");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName,  raceDate, resultsLink,  resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '138320', '897808', 2, 'NH Corn Hole Biathlon Race 5.0 Miler', '2024-11-24', 'https://runsignup.com/Race/Results/138320#resultSetId-512694;perpage:100', 'NH Corn Hole Biathlon 5 miler Overall Results', 1000, "place");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName,  raceDate, resultsLink,  resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '172769', '910689', 
    3, 
    'The Great Gingerbread Run Run As Fast As You can 5k!', 
    '2024-12-22', 
    'https://runsignup.com/Race/Results/172769#resultSetId-515330;perpage:100', 
    'The Great Gingerbread Run Run As fast As You Can 5K Overall Results', 
    1000, 
    "place");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName,  raceDate,  resultsLink, resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '173314', '914937', 4, 'Hopkinton Winter 5k Series Race #1', '2025-1-5', 'https://runsignup.com/Race/Results/173314#resultSetId-521646;perpage:100', 'Overall Results', 1000, "place");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName,  raceDate, resultsLink, resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '154718', '907168', 5, 'Hopkinton Winter 5k Series Race 2 January 19, (9am)', '2025-1-19', 'https://runsignup.com/Race/Results/154718#resultSetId-523610;perpage:100', 'Overall Results', 1000, "place");

insert into series_events (seriesId, source, raceId, eventId, raceNumber, raceName,  raceDate, resultsLink, resultsSetName, maxPoints, alg)
  values (@last_series_id, 'runsignup', '157507', '907184', 6, 'Hopkinton Winter 5k Series Race 3 (2/2 at 9:00 am)', '2025-2-2', 'https://runsignup.com/Race/Results/157507#resultSetId-526056;perpage:100', 'Overall Results', 1000, "place");

select * from series_events;

CREATE TABLE `series_participants` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `seriesId` int(4),
  `participantName` varchar(128),
  `age` int(4),
  `sex` char(3),
  `division` varchar(32) default '',
  `race1Points` decimal(8,2) default 0.0,
  `race1Time` varchar(32) default '',
  `race2Points` decimal(8,2) default 0.0,
  `race2Time` varchar(32) default '',
  `race3Points` decimal(8,2) default 0.0,
  `race3Time` varchar(32) default '',
  `race4Points` decimal(8,2) default 0.0,
  `race4Time` varchar(32) default '',
  `race5Points` decimal(8,2) default 0.0,
  `race5Time` varchar(32) default '',
  `race6Points` decimal(8,2) default 0.0,
  `race6Time` varchar(32) default '',
  `race7Points` decimal(8,2) default 0.0,
  `race7Time` varchar(32) default '',
  `race8Points` decimal(8,2) default 0.0,
  `race8Time` varchar(32) default '',
  `race9Points` decimal(8,2) default 0.0,
  `race9Time` varchar(32) default '',
  `race10Points` decimal(8,2) default 0.0,
  `race10Time` varchar(32) default '',
  `totalPoints1` decimal(8,2) default 0.0,
  `totalPoints2` decimal(8,2) default 0.0,
  `overallPlace1` int(4) default 0,
  `overallPlace2` int(4) default 0,
  `divisionPlace1` int(4) default 0,
  `divisionPlace2` int(4) default 0,
  `totalRaces1` int(4) default 0,
  `totalRaces2` int(4) default 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
