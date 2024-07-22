# Rezervační Systém

Vítejte v repozitáři Rezervačního Systému! Tento projekt je webová aplikace pro efektivní správu rezervací. Umožňuje uživatelům snadno vytvářet, aktualizovat a potvrzovat rezervace, přičemž automaticky odesílá potvrzovací e-maily.

## Obsah
- [Popis](#popis)
- [Použité technologie](#použité-technologie)
- [Struktura projektu](#struktura-projektu)
- [API](#api)
- [Knihovna PHPMailer](#knihovna-phpmailer)

## Popis

Rezervační Systém je webová aplikace, která poskytuje následující funkce:

- **Formulář pro rezervace**: Uživatelé mohou zadat informace o rezervaci (jméno, telefonní číslo, e-mail, počet osob, datum a čas).
- **Vytváření rezervace**: Nové rezervace jsou automaticky ukládány do databáze.
- **Aktualizace rezervace**: Uživatelé mohou aktualizovat existující rezervace na základě telefonního čísla a data.
- **Potvrzení rezervace**: Po úspěšném vytvoření nebo aktualizaci rezervace je automaticky odeslán potvrzovací e-mail.
- **Živý chat**: Komunikace s uživateli v reálném čase prostřednictvím API Tawk.to.

## Použité technologie

### Frontend
- **HTML5**: Struktura webové stránky.
- **CSS3**: Stylování webové stránky.

### Backend
- **PHP**: Zpracování dat a interakce s databází.
- **MySQL**: Databáze pro ukládání informací o rezervacích.
- **PHPMailer**: Knihovna pro odesílání e-mailů z PHP aplikací.

### Vývojové nástroje
- **XAMPP**: Lokální webový server obsahující Apache, MySQL a PHP.
- **Apache Server**: Webový server pro provoz PHP aplikací.

## Struktura projektu

- `index.php`: Hlavní stránka s formulářem pro rezervace, zpracováním formuláře a odesíláním potvrzovacích e-mailů.
- `conn.php`: Připojení k MySQL databázi.
- `css/style.css`: Stylování stránky.
- `PHPMailer-master`: Knihovna PHPMailer pro odesílání e-mailů.

## API

Projekt obsahuje následující API:

- **Tawk.to chat**: API pro integraci živého chatu Tawk.to, který umožňuje komunikaci s uživateli v reálném čase.

## Knihovna PHPMailer

PHPMailer je použita k odesílání potvrzovacích e-mailů v tomto projektu. Konkrétně slouží k:

- **Odesílání e-mailů s potvrzením rezervace**: Po úspěšném vytvoření nebo aktualizaci rezervace je automaticky odeslán e-mail s podrobnostmi o rezervaci. Tímto způsobem PHPMailer zajišťuje, že uživatelé dostanou okamžité potvrzení a jsou informováni o všech důležitých detailech.
