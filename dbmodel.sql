
-- ------
-- BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
-- DeepDive implementation : © Connor Rask connor@srask.ca
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Example 1: create a standard "card" table to be used with the "Deck" tools (see example game "hearts"):


-- Example 2: add a custom field to the standard "player" table
ALTER TABLE `player` ADD `meeple1` VARCHAR(16) NOT NULL DEFAULT 'hand';
ALTER TABLE `player` ADD `meeple2` VARCHAR(16) NOT NULL DEFAULT 'hand';
ALTER TABLE `player` ADD `meeple3` VARCHAR(16) NOT NULL DEFAULT 'hand';
ALTER TABLE `player` ADD `depth` INT NOT NULL DEFAULT 0;