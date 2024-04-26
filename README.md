# Pixelum

www.pixelum.pl


### Jak uruchomić stronę lokalnie?

1. Jeżeli jeszcze nie masz to zainstaluj [Node.js](https://nodejs.org/en/)
2. Sklonuj repozytorium przy pomocy komendy `git clone`
3. Przejdź do katalogu z projektem
4. Otwórz terminal w głównym katalogu gdzie znajduje się projekt i zainstaluj zależności przy pomocy komendy `npm install`
5. Uruchom serwer deweloperski przy pomocy komendy `npm run start`
6. Strona będzie dostępna pod adresem [http://localhost:8080/](http://localhost:8080/)

---

### Edytowanie strony.
- Aby zedytować stronę należy edytować plik index_dev.html, który znajduje się w głównym katalogu projektu.
- Aby zedytować style strony należy edytować pliki w katalogu `./assets/css/`.

> W katalogu tym znajdują się dwa pliki. `style.css` oraz `style-important.css`.
> - `style.css` - jest plikiem który podlega procesowi tree-shakingu na podstawie strony index_dev.html.
> - `style-important.css` - jest plikiem który zawiera style, które nie podlegają procesowi tree-shakingu, a to ze względu na stylowanie po klasach które są generowane dynamicznie przez skrypty.

- Wszystkie pliki z katalogu `./assets/build` są plikami zależnymi, które są generowane przy pomocy komendy `npm run build`.
- Nie należy edytować tych plików, ponieważ zmiany zostaną nadpisane przy kolejnym budowaniu strony.

---

### Jak zaktualizować stronę?

1. Otwórz terminal w głównym katalogu gdzie znajduje się projekt
2. Bądź pewny, że masz zainstalowane zależności przy pomocy komendy `npm install`
3. Uruchom komendę `npm run build`
4. Po uruchomieniu komendy zostaną wygenerowane pliki strony:
    - `./index.html`
    - `./assets/build/`
        - `style.min.css`
        - `vendors.min.css` - które zawiera:
            - `swiper-bundle.min.css`
            - `glightbox.min.css`
        - `script-bundle.min.js` - które zawiera:
            - `bootstrap.bundle.js`
            - `swiper-bundle.min.js`
            - `glightbox.min.js`
            - `purecounter_vanilla.js`
            - `validate.js`
            - `main.js`

