# Mijn Café

Een Laravel 12 project voor het vak *Backend Web* – een dynamische website voor een koffiebar met gebruikersbeheer, nieuws, bestellingen en meer.

<<<<<<< Updated upstream
# Inhoud
=======
## Inhoud
>>>>>>> Stashed changes

- [Beschrijving](#beschrijving)
- [Functionaliteiten](#functionaliteiten)
- [Installatie](#installatie)
- [Gebruikersaccounts](#gebruikersaccounts)
- [Screenshots](#screenshots)
- [Bronnen](#bronnen)

---

<<<<<<< Updated upstream
# Beschrijving
=======
## Beschrijving
>>>>>>> Stashed changes

Mijn Café is een full-stack Laravel webapplicatie gebouwd als eindproject voor het vak Backend Web. De website combineert gebruikersauthenticatie, profielbeheer, koffiebestellingen, nieuwsbeheer, FAQ-beheer en een contactformulier in een gebruiksvriendelijke en overzichtelijke interface.

Gebruikers kunnen inloggen, hun profiel beheren, bestellingen plaatsen en vragen stellen via het contactformulier of FAQ. Admins hebben extra rechten zoals het beheren van gebruikers, het toekennen van adminrechten, het verwerken van contactberichten, het beheren van FAQ’s en het aanmaken van nieuwsitems die op de homepage verschijnen.

## Hoofuncties
- Gebruikersauthenticatie: inloggen, registreren, wachtwoord reset, ‘remember me’
- User Roles: gewone gebruiker & admin, met adminmogelijkheden (promoveren/degraderen, manueel aanmaken)
- Profielpagina’s: publieke profiellijst, bewerken eigen profiel (username, profielfoto, verjaardag, "over mij")
- Nieuwsitems: lijst en detail, admin CRUD (Titel, Afbeelding, Content, Publicatiedatum)
- FAQ-pagina: vragen en antwoorden per categorie, admin CRUD
- Contactformulier: aanvragen via formulier, e-mailnotificatie naar admin, admin-overzicht
---

<<<<<<< Updated upstream
# Functionaliteiten
###implementatie van Technishe Vereisten

##Views & Blade

###Twee layouts

- resources/views/layouts/app.blade.php (regels 1–80): hoofdlayout voor ingelogde gebruikers

- resources/views/layouts/guest.blade.php (regels 1–50): layout voor niet-ingelogde bezoekers

##Componenten

- resources/views/components/navbar.blade.php (regels 1–30)

- resources/views/components/footer.blade.php (regels 1–20)

##Routes

- Alle routes via controllers

- routes/web.php (regels 10–75): publiek

- routes/admin.php (regels 1–60): admin (prefix admin, middleware auth,verified)

  ##Middleware

- Route::middleware(['auth'])->group(...) rond profiel- en admin-routes

##Controllers & Models

###Resource Controllers

- app/Http/Controllers/Admin/NewsController.php (CRUD, regels 1–120)

- app/Http/Controllers/FaqController.php (regels 1–100)

###Modulaire controllers

- app/Http/Controllers/ProfileController.php (regels 1–80)

###Eloquent Models

- app/Models/User.php (relaties met profiel, nieuwsfavorieten)

- app/Models/News.php (belongsTo(User::class), regels 25–35)

- app/Models/FaqCategory.php (hasMany(Faq::class), regels 15–25)

##Database

###Migrations

- database/migrations/2025_01_10_000000_create_users_table.php (toegevoegd is_admin, avatar, birthday)

- database/migrations/2025_02_05_000000_create_news_table.php (velden: title, image_path, content, published_at)

- database/migrations/2025_02_20_000000_create_faq_tables.php (faq_categories en faqs)

###Seeders

 - database/seeders/DatabaseSeeder.php (registreert UserSeeder, FaqSeeder, NewsSeeder)

###Security

- CSRF Bescherming

- Overal in Blade-formulieren @csrf (zoek in resources/views)

### XSS Bescherming

- Output in Blade ge-escaped met {{ }} (bijv. in news/show.blade.php regel 45)

### Client-side Validatie

- HTML5 Validatie: required, type="email", pattern in formuliervelden (resources/views/contact.blade.php regels 12–40)

- Optioneel: Vue.js voor live validatie (npm-pakket geïnstalleerd in package.json)

###Authentication

- Auth::routes() in routes/web.php (regel 7)

- Standaard functionaliteiten: login, register, password reset (controller in vendor/laravel/ui)

- Default Admin

- Voeg toe in database/seeders/UserSeeder.php (regel 15–25) met:

User::create([    
    'name' => 'admin',
    'email' => 'admin@ehb.be',
    'password' => Hash::make('Password!321'),
    'is_admin' => true,
]);




# Algemene functies
=======
## Functionaliteiten

### Algemene functies
>>>>>>> Stashed changes
- *Homepage met dynamische inhoud:* toont koffiesoorten (met afbeelding), recente nieuwsitems en veelgestelde vragen.
- *Contactformulier:* bezoekers kunnen berichten sturen; admins ontvangen deze via e-mail.
- *Publieke profielpagina’s:* elke gebruiker heeft een publiek profiel met foto, bio en info en kunnen wijzigen van hun profielen en zelfs de admin kan rechten op geven of ze admin rechten hebben.

<<<<<<< Updated upstream
# Authenticatie & Gebruikersbeheer
=======
### Authenticatie & Gebruikersbeheer
>>>>>>> Stashed changes
- *Registratie en login* met wachtwoordbeveiliging en ‘wachtwoord vergeten’-functie.
- *Gebruikersdashboard* na inloggen.
- *Profiel aanpassen:* naam, gebruikersnaam, profielfoto, bio, verjaardag.
- *Admins kunnen gebruikers beheren* (aanmaken, wijzigen, verwijderen).
- *Adminrechten toekennen/intrekken*.

<<<<<<< Updated upstream
# Bestellingen
=======
### Bestellingen
>>>>>>> Stashed changes
- *Koffies bestellen:* via een dynamisch menu.
- *Mijn bestellingen:* overzicht voor elke gebruiker.
- *Bestelbeheer:* admins kunnen alle bestellingen bekijken.

<<<<<<< Updated upstream
# Nieuwsbeheer
=======
### Nieuwsbeheer
>>>>>>> Stashed changes
- *Nieuws aanmaken, bewerken, verwijderen* door admins.
- *Nieuwsitems bevatten:* titel, content, afbeelding, publicatiedatum, auteur.
- *Nieuwsweergave op homepage* en aparte nieuwssectie.
- *Detailpagina per nieuwsitem.*
<<<<<<< Updated upstream

# FAQ-beheer
- *Adminbeheer:* beheer van categorieën en Q&A.
- *FAQ’s zichtbaar op homepage* gegroepeerd per categorie.
- *Bezoekers kunnen vragen insturen*, zichtbaar voor admin in dashboard.

---

# Installatie

1. *Clone deze repository:*

   ```bash
   git clone https://github.com/kiranchaudry97/Mijn-Cafe.git
   cd Mijn-Cafe

3. * Dependencies installeren
     composer install
     npm install
    npm run build


### logegevens 
* E-mail: admin@ehb.be
* Wachtwoord: Password!321



  E-mail: login@ehb.be

Wachtwoord: Password!321

## Gebruikte Bronnen
* chatgtp : gebruikt vooral ik had problemen gehad met symlink en storage van het uploaden van afbeeldingen en het bewaren maar dit was niet gelukt, zelf moeten opzoeken van deze bron : https://stackoverflow.com/questions/68124304/laravel-8-symbolic-link-not-appearing-in-public#:~:text=So%20when%20you%20run%20php%20artisan%20storage%3Alink%20it,your%20public%20folder%20and%20delete%20the%20storage%20folder. en youtube werd een notatie getoond bij de web router zo heb ik dit zo geplaats Route::get('/storage-link', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = public_path('storage');

    if (!file_exists($linkFolder)) {
        symlink($targetFolder, $linkFolder);
        return 'Symlink succesvol aangemaakt!';
    }

  


# Afbeeldingen 
## Hoofd pagina
### inhoud welkom bericht met menu en de item die ze kunnen bestellen.

 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/menupagina/menu.png)
# veelgestelde vragen kunnen weergeven
 
 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/faq/heb%20je%20een%20vraag.png)
   ![image alt]( 
https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/homepagina/nieuwbeheer.png)

   ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/homepagina/veelgestelde_vragen.png)

   #nieuwbeheer
   ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/e23d81d44c7e3342550cdea330d9db755abf953f/Afbeeldingen%20project%20backend/homepagina/update_nieuwsbeheer_verschijnen.png)
   

   
   ![image alt]()

# Menu pagina 
 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/contact/contact.png)
 
# Contactinfo pagina
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/3dfef042ced5bd9cd539ba024e8f343332bbe211/contact%20info%20pagina%20.png)
 
##GebruikersProfielen

![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/gebruikersprofielen/gebruikers.png)

###Gebruikers info

  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/gebruikersprofielen/gebruikersinfo.png)

## log 
 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log.png)

 ## gebruikers/Admin

 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/gebuikers%20logegevens.png)

 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/log%20admin.png)



 ![image alt]()


## Admin/Gebruikes Dashboard
 
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/admin%20dashboard.png)

 ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/dashboard.png)

### Admin Faqbeheer
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/faqbeheer.png)

### Admin Faq aanmaken
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/faqaanmaken.png)
  
### Admin nieuws beheer
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/beheernieuws.png)
  
### Admin gebruikers beheren
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/gebruikerbeheren.png) 

### Admin gebruikersprofielen
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/gebruikersprofielen.png)

  
### Admin contact inzendingen
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/inzendingen.png)  

### Admin Reactiebeheer
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/admin/reactie%20beheer.png)  

### Bestellingen aanmaken
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/bestel/bestellingen%20aanmaken.png)  

### Bestellingen 
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/bestel/bestellingen.png)  
  


### profile bewereken
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/profile%20bewerken/bewerking.png)  


 ### wachtwoord wijzigen of account verwijderen
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/profile%20bewerken/wachtwoord%20gegevens.png)  

### mailtrap notifactie van herstel link 
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/mailtrap/mailtrap%20van%20wachtwoord%20vergeten%20link.jpg)    


![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/logegevens/log%20gebruikers/mailtrap/notificatie%20van%20herstel%20link.jpg)  


### testing Faq
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/Faq_test_aanmaken.png)  



### testing profile bewereken
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/Profile_test_aanpassen.png)  

### testing gebruikers aanmaken
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/Test_gebruikers_aanmaken_admin%20.png)  

### testing amin rechten aanpassen
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/admin_rechten_aanpassen.png)  


### testing bestellingen
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/test_bestellingen.png)  


### testing contact inzendingen
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/contactverzenden_test.png)  


### testing gebruikers verwijderen ( er waren in begin kijk boven 5)
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/test_gebruikers_verwijderen.png)  


### testing niewsbeheer
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/test_nieuwsbeheer.png)  

### testing reactie
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/test_reactie.png)  



### testing verwijderen van faq
  ![image alt](https://github.com/kiranchaudry97/Mijn-Cafe/blob/9571c2d1188559d687903f5a64a5df3302bd61a4/Afbeeldingen%20project%20backend/Nieuwe%20map/test_verwijderen_faq_item.png)  



  
  
