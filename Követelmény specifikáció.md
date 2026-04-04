**Követelményspecifikáció**

**Projektneve:** Időjáráselőrejelző rendszer  
**Dátum**: 2025.11.10  
**Készítette**: AFP1 csapat



**1.**    **Bevezetés**

A projekt célja egy webalapú időjárás előrejelző rendszerkészítése. A felhasználónak a weblap segítségével lehetősége van a jelenlegi, illetve legfeljebb 5 napon belüli előrejelzéseket megtekinteni. Meg tudja nézni minden egyes napra az adott napon elérhető minimális, illetve maximális hőmérsékletet, és az égbolt alakulását (például napos, felhős, borult, ködös, stb.).

Egy kereső mező segítségével a felhasználó egy másik településre is rá tud keresni, ezáltal az adott település előrejelzéseit is meg tudja nézni.

A rendszer egy külső API-t fog használni, amely segítségével le lehet kérni a külső API által adott időjárás adatokat.

Ezen felül elérhető lesz egy mesterséges intelligencia által generált ruházati javaslat, ami a felhasználókat segíti az időjáráshoz megfelelő ruházat kiválasztásában. Meleg, napos időben vékonyabb ruházatot, hűvösebb, szeles időben pedig melegebb ruházatot fog javasolni.

Bizonyos felhasználók be fognak tudni jelentkezni admin felhazsnálóként is, ezzel az eddigi időjárás jelentések adait le tudják tölteni egy .txt fájlban.


**2.**    **Célok** **és** **funkciók**

·       Jelenlegi és következő pár napban várható időjárás jelzése.

·       Minimum, maximum hőmérséklet értékek kiiratása.

·       Másik városra rá lehessen keresni.

·       Meg lehessen nézni más település előrejelzéseit is.

·       Valós idejű helymeghatározás

·       MI által generált öltözködési javaslat, ami az időjárásnak megfelelően ad javaslatokat.



**3.**   **Érintettek és szerepkörök**

·       Felhasználó: meg tud tekinteni egy adott város előrejelzését.

·       Admin: meg tudja tekinteni az elmúlt jelzéseket is, a felhasználóval ellentétben.



**4.**   **Funkcionális követelmények**

·       A weboldal kezdőlapján a felhasználó lokációja alapján megjeleníti az aktuális időjárást, illetve a várható alakulását.

·       A felhasználó által megadott városnak az előre jelzéseit megmutatja, ha a felhasználó a keresőbe beír egy városnevet.

·       Megjeleníti a naponta várható minimum és maximum hőmérsékletet



**5.**   **Nem funkcionális követelmények**

·       Egyszerű, egyértelmű UI.

·       Valós idejű jelentés.



**6.**   **Rendszerkörnyezet**

·       Technológia: php, html, javascript, css

·       Futtatás: internet böngésző



**7.**   **Korlátozások**

·       A projekt nem tartalmaz MI funkciókat az elején.

·       Először a keresőből lehessen kiválasztani a megfelelő várost, és annak mutassa az előrejelzéseit.



**8.**   **Példa felhasználói történet**

A program elindítása után megjelenik egy ablak jelenik meg, ahol megjelenik a felhasználó lokációja alapján a helyi előrejelzés. Feljebb látható az aktuális hőmérséklet, az adott napnak az előrejelzése, és hogy milyen éppen és milyen lesz az égbolt. Az aktuális előrejelzés alatt lehet majd látni a következő napokban várható időjárást, minden napon a minimális és maximális hőmérsékletet mutatva, illetve milyen égbolt várható (napos, felhős, borult, stb.).

Az ablak tetején lévőkeresőbe be tud írni egy városnevet. Városnév megadása után a lokáció alapú jelentés helyett a kiválasztott település időjárás előrejelzése jelenik meg. Teljesen ugyanolyan felépítésben, vagyis feljebb látható az adott napnak az előrejelzése, majd alatta legfeljebb 5 napnyi előrejelzés, hogy milyen idő várható akkor.

A beimplementált MI segítségével tudunk javaslatokat kérni tőle, hogy milyen ruhát érdemes felvennünk aznapra. Ha az MI úgy veszi, elég meleg van aznap, akkor könnyebb ruházatot javasol a felhasználónak, például rövidnadrág, póló, sportcipő. Hűvösebb időben ezek helyett hosszú nadrágot, pulóvert, esetleg kabátot, sálat, sapkát javasol.

A felhasználó bejelentkezése után megjelenik az exportálás gomb, amelyre kattintva a megadott dátumok adatait egy .txt fájlként letölti.



**9.**   **Elfogadási kritériumok**

·       Helyes előrejelzés.

·       Másik városra lehet keresni.

·       Megjeleníti a másik városelőrejelzéseit is.



**10.****Jövőbeli bővítési** **lehetőségek**

·       MI, ami megfelelő öltözködési javaslatot ad.
