INSERT OR REPLACE INTO "player_data" ("uuid", "username", "isOnline", "firstSeen", "lastSeen") VALUES 
  ('00000000-0000-0000-0000-000000000000', 'Steve', '0', '5/31/25, 8:29 AM', '6/9/25, 4:00 AM'),
  ('00000000-0000-0000-0000-000000000001', 'Alex', '1', '6/12/25, 10:15 AM', '9/14/26, 6:30 PM'),
  ('00000000-0000-0000-0000-000000000002', 'Zuri', '0', '7/05/25, 2:45 PM', '9/12/26, 11:20 PM'),
  ('00000000-0000-0000-0000-000000000003', 'Efe', '1', '8/20/25, 9:00 AM', '9/14/26, 6:15 PM'),
  ('00000000-0000-0000-0000-000000000004', 'Sunny', '0', '12/01/25, 7:30 PM', '9/10/26, 1:10 AM');

INSERT OR REPLACE INTO "skins" ("uuid", "url") VALUES 
  ('00000000-0000-0000-0000-000000000000', 'https://textures.minecraft.net/texture/67d51b2b76d79a321f69409d0ea1aced77ca134e1307da055583d51911dec0e'),
  ('00000000-0000-0000-0000-000000000001', 'https://textures.minecraft.net/texture/15084bfec141ada510f6a539475442df051d9114e4d4cf6f5f898afb2a057433'),
  ('00000000-0000-0000-0000-000000000002', 'https://textures.minecraft.net/texture/95b6337ab9646797940746be4e18c579bfee5eca9af78bb41049aedde49b5e3b'),
  ('00000000-0000-0000-0000-000000000003', 'https://textures.minecraft.net/texture/7c122ce26b88dec0b373e6fd1ca7cbd441ac6484c96056f5e2134b651e593472'),
  ('00000000-0000-0000-0000-000000000004', 'https://textures.minecraft.net/texture/8c2dbb75de965c3724687641a6a885800c62f1825350735ff3a145f575b8c551');


INSERT OR REPLACE INTO "statistics" ("uuid", "advancements", "blocksMined", "blocksPlaced", "damageAbsorbed", "damageDealt", "damageTaken", "damageResisted", "distanceTraveled", "deaths", "level", "mobsKilled", "playersKilled", "playTime", "timeSinceLastDeath") VALUES
  ('00000000-0000-0000-0000-000000000000', 8, 3177, 2382, 0, 1828, 2698, 150, 21861, 3, 17, 45, 0, 356811, 46290),
  ('123e4567-e89b-12d3-a456-426614174000', 14, 5210, 4105, 320, 3450, 4120, 400, 54200, 1, 28, 112, 1, 612400, 185000),
  ('987f6543-a21b-45c6-d789-1234567890ab', 4, 1850, 920, 0, 950, 1420, 50, 12500, 6, 9, 21, 0, 145200, 8400),
  ('a1b2c3d4-e5f6-7890-abcd-ef1234567890', 21, 8432, 7150, 1150, 6100, 5800, 950, 89100, 2, 34, 280, 2, 984500, 342100),
  ('11112222-3333-4444-5555-666677778888', 2, 410, 250, 0, 310, 550, 0, 4800, 8, 4, 9, 0, 54100, 1200);
