PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE recipe(
  "id" INTEGER PRIMARY KEY,
  "created_at" TEXT,
  "updated_at" TEXT,
  "box_type" TEXT,
  "title" TEXT,
  "slug" TEXT,
  "short_title" TEXT,
  "marketing_description" TEXT,
  "calories_kcal" INTEGER,
  "protein_grams" INTEGER,
  "fat_grams" INTEGER,
  "carbs_grams" INTEGER,
  "bulletpoint1" TEXT,
  "bulletpoint2" TEXT,
  "bulletpoint3" TEXT,
  "recipe_diet_type_id" TEXT,
  "season" TEXT,
  "base" TEXT,
  "protein_source" TEXT,
  "preparation_time_minutes" INTEGER,
  "shelf_life_days" INTEGER,
  "equipment_needed" TEXT,
  "origin_country" TEXT,
  "recipe_cuisine" TEXT,
  "in_your_box" TEXT,
  "gousto_reference" INTEGER
);
INSERT INTO "recipe" VALUES(1,'30/06/2015 17:58:00','30/06/2015 17:58:00','vegetarian','Sweet Chilli and Lime Beef on a Crunchy Fresh Noodle Salad','sweet-chilli-and-lime-beef-on-a-crunchy-fresh-noodle-salad','','Here we''ve used onglet steak which is an extra flavoursome cut of beef that should never be cooked past medium rare. So if you''re a fan of well done steak, this one may not be for you. However, if you love rare steak and fancy trying a new cut, please be',401,12,35,0,'','','','meat','all','noodles','beef',35,4,'Appetite','Great Britain','asian','',59);
INSERT INTO "recipe" VALUES(2,'30/06/2015 17:58:00','30/06/2015 17:58:00','gourmet','Tamil Nadu Prawn Masala','tamil-nadu-prawn-masala','','Tamil Nadu is a state on the eastern coast of the southern tip of India. Curry from there is particularly famous and it''s easy to see why. This one is brimming with exciting contrasting tastes from ingredients like chilli powder, coriander and fennel seed',524,12,22,0,'Vibrant & Fresh','Warming, not spicy','Curry From Scratch','fish','all','pasta','seafood',40,4,'Appetite','Great Britain','italian','king prawns, basmati rice, onion, tomatoes, garlic, ginger, ground tumeric, red chilli powder, ground cumin, fresh coriander, curry leaves, fennel seeds',58);
INSERT INTO "recipe" VALUES(3,'30/06/2015 17:58:00','30/06/2015 17:58:00','vegetarian','Umbrian Wild Boar Salami Ragu with Linguine','umbrian-wild-boar-salami-ragu-with-linguine','','This delicious pasta dish comes from the Italian region of Umbria. It has a smoky and intense wild boar flavour which combines the earthy garlic, leek and onion flavours, while the chilli flakes add a nice deep aroma. Enjoy within 5-6 days of delivery.',609,17,29,0,'','','','meat','all','pasta','pork',35,4,'Appetite','Great Britain','british','',1);
INSERT INTO "recipe" VALUES(4,'30/06/2015 17:58:00','30/06/2015 17:58:00','gourmet','Tenderstem and Portobello Mushrooms with Corn Polenta','tenderstem-and-portobello-mushrooms-with-corn-polenta','','One for those who like their veggies with a slightly spicy kick. However, those short on time, be warned '' this is a time-consuming dish, but if you''re willing to spend a few extra minutes in the kitchen, the fresh corn mash is extraordinary and worth a t',508,28,20,0,'','','','vegetarian','all','','cheese',50,4,'None','Great Britain','british','',56);
INSERT INTO "recipe" VALUES(5,'30/06/2015 17:58:00','30/06/2015 17:58:00','vegetarian','Fennel Crusted Pork with Italian Butter Beans','fennel-crusted-pork-with-italian-butter-beans','','A classic roast with a twist. The pork loin is marinated in rosemary, fennel seeds and chilli flakes then teamed with baked potato wedges and butter beans in tomato sauce. Enjoy within 5-6 days of delivery.',511,11,62,0,'A roast with a twist','Low fat & high protein','With roast potatoes','meat','all','beans/lentils','pork',45,4,'Pestle & Mortar (optional)','Great Britain','british','pork tenderloin, potatoes, butter beans, garlic, fennel seeds, medium onion, chilli flakes, fresh rosemary, tomatoes, vegetable stock cube',55);
INSERT INTO "recipe" VALUES(6,'01/07/2015 17:58:00','01/07/2015 17:58:00','gourmet','Pork Chilli','pork-chilli','','Succulent pork tenderloin and feathery white bean and parsnip mash mingle with feisty cumin seeds and tangy leek in this lighter, less conventional take on a British classic. Welcome to the outer limits of food!',401,12,35,0,'','','','meat','all','','pork',35,4,'Appetite','Great Britain','asian','',60);
INSERT INTO "recipe" VALUES(7,'02/07/2015 17:58:00','02/07/2015 17:58:00','vegetarian','Courgette Pasta Rags','courgette-pasta-rags','','Kick-start the new year with some get-up and go with this lean green vitality machine. Protein-packed chicken and mineral-rich kale are blended into a smooth, nut-free version of pesto; creating the ultimate composition of nutrition and taste',524,12,22,0,'','','','meat','all','','chicken',40,4,'Appetite','Great Britain','british','',59);
INSERT INTO "recipe" VALUES(8,'03/07/2015 17:58:00','03/07/2015 17:58:00','vegetarian','Homemade Eggs & Beans','homemade-egg-beans','','A Goustofied British institution, learn how to make beautifully golden breaded chicken escalopes drizzled in homemade garlic butter and served atop fluffy potato and broccoli mash.',609,17,29,0,'','','','meat','all','','eggs',35,3,'Appetite','Great Britain','italian','',2);
INSERT INTO "recipe" VALUES(9,'04/07/2015 17:58:00','04/07/2015 17:58:00','gourmet','Grilled Jerusalem Fish','grilled-jerusalem-fish','','I love this super healthy fish dish, it contains a punch from zingy ginger, a kick from chili and a salty sweet balance from soy sauce and mirim. A cleansing and restorative meal, great for body and soul.',508,28,20,0,'','','','meat','all','','fish',50,4,'Appetite','Great Britain','mediterranean','',57);
INSERT INTO "recipe" VALUES(10,'05/07/2015 17:58:00','05/07/2015 17:58:00','gourmet','Sausage and Mash','pork-katsu-curry','','Comprising all the best bits of the classic American number and none of the mayo, this is a warm & tasty chicken and bulgur salad with just a hint of Scandi influence. A beautifully summery medley of flavours and textures',511,11,62,0,'','','','meat','all','','pork',45,4,'Appetite','Great Britain','british','',56);
CREATE TABLE rating(
  "id" INTEGER PRIMARY KEY,
  "created_at" TEXT,
  "updated_at" TEXT,
  "rating" INTEGER,
  "recipe_id" INTEGER,
  FOREIGN KEY(recipe_id) REFERENCES recipe(id)
);
INSERT INTO "rating" VALUES(1,NULL,NULL,5,1);
COMMIT;
