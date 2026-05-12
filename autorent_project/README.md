# Autorendi projekt: PHP + MySQL + Bootstrap 5

Lihtne õppeprojekt, mis katab avaliku autode nimekirja, otsingu, detailvaate, admin CRUD-i, admini sessiooniga kaitsmise, kasutajate registreerimise ja broneeringu kuupäevade kontrolli.

## Failistruktuur

```text
public/   avalikud lehed
admin/    admini vaated ja CRUD
inc/      andmebaasi ühendus, abifunktsioonid, header/footer
sql/      schema.sql ja seed.sql
```

## Käivitamine

1. Loo MySQL-is andmebaas ja tabelid:
   - impordi `sql/schema.sql`
   - impordi `sql/seed.sql`
2. Muuda vajadusel `inc/db.php` ühenduse andmeid.
3. Pane projekt näiteks XAMPP/WAMP/MAMP `htdocs` kausta.
4. Ava brauseris `public/index.php`.

## Testkasutajad

Admin:

```text
admin@example.com
admin123
```

Tavaline kasutaja:

```text
user@example.com
admin123
```

## Etappide seos

### Etapp 1
Bootstrap 5 kujundus: navbar, otsing, hero, autokaardid, grid ja pagination.

### Etapp 2
`cars` tabel ja autode kuvamine MySQL-ist.

### Etapp 3
Otsing GET-parameetriga `q`, filtreerib `mark` ja `model` väljade järgi.

### Etapp 4
Detailvaade `auto.php?id=...`, kus kuvatakse ühe auto info.

### Etapp 5
`cars` tabelis on lisaväljad: `year`, `transmission`, `seats`, `description`, `status`.

### Etapp 6
Admin CRUD: autode lisamine, muutmine ja kustutamine.

### Etapp 7
Admin on kaitstud sessiooniga. Kui admin pole sisse loginud, suunatakse `admin/login.php` lehele.

### Etapp 8+
Lisatud `users` ja `reservations` tabelid. Kasutaja saab registreerida, sisse logida ja detailvaates auto kuupäevadega broneerida. Hind arvutatakse valemiga:

```text
päevade arv × auto hind päevas
```

### Etapp 9
Broneering ei salvestu, kui sama auto aktiivne broneering kattub uue perioodiga.

Kattumise kontroll:

```sql
WHERE car_id = ?
AND status = 'active'
AND (? <= end_date)
AND (? >= start_date)
```

## Märkus

Projekt kasutab `mysqli` prepared statement'e, `password_hash` / `password_verify` paroole ja minimaalset Bootstrap 5 kujundust.
