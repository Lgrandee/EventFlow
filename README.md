# EventFlow
EventFlow is een webplatform waarmee organisatoren evenementen kunnen aanmaken, beheren en 
publiceren. Bezoekers kunnen het aanbod bekijken en zich inschrijven voor evenementen die hen 
aanspreken. Het platform is bedoeld voor een breed scala aan evenementen: van workshops en 
netwerkborrels tot conferenties en sporttoernooien. 
EventFlow werkt met een eenvoudig inschrijfsysteem. Bezoekers registreren zich als deelnemer en kunnen 
zich aanmelden voor evenementen zolang er nog plekken beschikbaar zijn. Organisatoren beheren de 
evenementen via een beveiligd beheerpaneel. De hoofdbeheerder heeft daarnaast de bevoegdheid om 
nieuwe organisatoraccounts aan te maken en bestaande te deactiveren. 


Hieronder vindt u alle benodigde informatie om de EventFlow-website correct op te starten.

Download de .ZIP-file van de repository en pak deze uit op de lokale path naar keuze.

Open het uitgepakte project in je editor.

.env.example naar .env maken. Voer dit commando uit in de terminal: "copy .env.example .env".

Als die klaar is, voer "composer install" uit in de terminal.

Wacht tot Composer klaar is en voer "npm install" in de terminal.

Wacht tot npm install klaar is en voer "php artisan key:generate" in de terminal.

Als de key is gegenereerd, voer "php artisan migrate" en daarna "php artisan db:seed".

Daarna kunt u "npm run dev" in de terminal laten draaien.

De website is nu klaar voor gebruik. Let op! Zorg dat je een manier hebt om de website lokaal te draaien. Denk aan Laravel herd.

Voor herd kunt u dit gebruiken

Open herd > Add Project > Select EventFlow Project map.

