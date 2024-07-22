Rezervační Systém
Vítejte v repozitáři Rezervačního Systému. Tento projekt je webová aplikace pro správu rezervací, která umožňuje uživatelům vytvářet, aktualizovat a potvrzovat rezervace. Aplikace také automaticky odesílá potvrzovací e-maily.

Obsah
Popis
Použité technologie
Struktura projektu
API
Knihovna PHPMailer
Popis
Rezervační Systém je webová aplikace určená k efektivnímu spravování rezervací. Na této webové stránce najdete:

Formulář pro rezervace: Uživatelé mohou zadat informace o rezervaci, včetně jména, telefonního čísla, e-mailu, počtu osob, data a času rezervace.
Vytváření rezervace: Uživatelé mohou vytvořit novou rezervaci, která je automaticky uložena do databáze.
Aktualizace rezervace: Uživatelé mohou aktualizovat existující rezervace na základě telefonního čísla a data.
Potvrzení rezervace: Po úspěšném vložení nebo aktualizaci rezervace je odeslán potvrzovací e-mail s informacemi o rezervaci.
Živý chat: Implementace chatu pomocí API Tawk.to pro komunikaci s uživateli v reálném čase.
Použité technologie
Frontend
HTML5: Struktura webové stránky.
CSS3: Stylování webové stránky.
Backend
PHP: Zpracování dat a interakce s databází.
MySQL: Databáze pro ukládání informací o rezervacích.
PHPMailer: Knihovna pro odesílání e-mailů z PHP aplikací.
Vývojové nástroje
XAMPP: Lokální webový server obsahující Apache, MySQL a PHP.
Apache Server: Webový server pro provoz PHP aplikací.
Struktura projektu
index.php: Hlavní stránka obsahující formulář pro rezervace, zpracování formuláře a odesílání potvrzovacích e-mailů.
conn.php: Soubor pro připojení k MySQL databázi a pomocné funkce pro práci s databází.
css/style.css: Stylování stránky.
PHPMailer-master/: Knihovna PHPMailer pro odesílání e-mailů.
API
Projekt obsahuje následující API:

Tawk.to chat: API pro integraci živého chatu Tawk.to, který umožňuje komunikaci s uživateli v reálném čase.

Knihovna PHPMailer
PHPMailer je v tomto projektu použita k odesílání potvrzovacích e-mailů. Konkrétně se využívá pro:

Odesílání e-mailů s potvrzením rezervace: Po úspěšném vytvoření nebo aktualizaci rezervace je uživateli automaticky odeslán e-mail s podrobnostmi o rezervaci, včetně jména, telefonního čísla, e-mailu, počtu osob, data a času rezervace.
Tímto způsobem PHPMailer zajišťuje, že uživatelé dostanou okamžité potvrzení o svých rezervacích a jsou informováni o všech důležitých detailech.
