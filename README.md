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
> - `style-important.css` - jest plikiem który zawiera style, które nie podlegają procesowi tree-shakingu,
>    a to ze względu na stylowanie po klasach które są generowane dynamicznie przez skrypty.

- Wszystkie pliki z katalogu `./assets/build` są plikami zależnymi, które są generowane przy pomocy komendy `npm run build`.
  Nie należy edytować tych plików, ponieważ zmiany zostaną nadpisane przy kolejnym budowaniu strony.

---

### Jak zaktualizować stronę?

1. Otwórz terminal w głównym katalogu gdzie znajduje się projekt
2. Bądź pewny, że masz zainstalowane zależności przy pomocy komendy `npm install`
3. Uruchom komendę `npm run build`
4. Po uruchomieniu komendy zostaną wygenerowane pliki strony:
    - `./index.html`
    - `./assets/build/`
        - `style.min.css` - który zawiera:
            - `bootstrap.css`
            - `style.css`
            - `style-important.css`
        - `vendors.min.css` - który zawiera:
            - `swiper-bundle.min.css`
            - `glightbox.min.css`
        - `script-bundle.min.js` - który zawiera:
            - `bootstrap.bundle.js`
            - `swiper-bundle.min.js`
            - `glightbox.min.js`
            - `purecounter_vanilla.js`
            - `validate.js`
            - `main.js`

---

### Jakie kroki zostały poczynione by zoptymalizować stronę?

Zdecydowałem się użyć któregoś z narzędzi do automatyzacji procesów.
Wybór padł na `gulp`, ponieważ jest to narzędzie, które jest łatwe w obsłudze i posiada wiele gotowych rozwiązań,
które mogą być użyte do zoptymalizowania strony.

1. Wygenerowałem package.json przy pomocy komendy `npm init -y`.
Node przechowuje w tym pliku zależności, które są potrzebne do automatyzacji procesu budowania strony.
2. Zainstalowałem właściwe zależności przy pomocy komendy `npm install`.
Głowną zależnością jest gulp, który jest odpowiedzialny za automatyzację procesu budowania strony.

>
>Dodatkowo zainstalowałem zależności, które są potrzebne do procesu budowania strony:
>    - `gulp-concat` - odpowiedzialny za konkatenację plików.
>    - `gulp-purgecss` - odpowiedzialny za usuwanie nieużywanych styli.
>    - `gulp-clean-css` - odpowiedzialny za minifikację plików css.
>    - `gulp-terser` - odpowiedzialny za minifikację plików js.
>    - `gulp-rename` - odpowiedzialny za zmianę nazwy plików.
>    - `gulp-inject` - odpowiedzialny za wstrzykiwanie plików do plików html.
>    - `gulp-htmlmin` - odpowiedzialny za minifikację plików html.

3. Stworzyłem plik `gulpfile.js`, który zawiera skrypty odpowiedzialne za proces budowania strony.
4. Stworzyłem plik `index_dev.html`, który jest plikiem źródłowym strony i z którego generowana jest strona główna `index.html`.
5. Następnie poczyniłem kroki służące do zoptymalizowania strony. W tym celu:
    -   Dla pierwszego renderu znaczenie miał obraz służący jako tło dla sekcji `#hero`. Przekonwertowałem go na `webp`.
    -   Stworzyłem pliki `style.css` oraz `style-important.css`, które zawierają style strony.
        W pliku `style-important.css` znajdują się style, które są niezbędne dla poprawnego stylowania strony
        w momencie dynamicznej podmiany html'owych klas przez któryś z skryptów js.
    -   Usunąłem ręcznie niepotrzebne zasoby z pliku `style.css` oraz `index_dev.html` które strona pobierała, takie jak:
        - Wszystkie czcionki. W zamian za to użyłem powszechnych dla komputerów czcionek,
          aby zapobiec niepotrzebnemu pobieraniu zasobów.
        - Czcionki ikon, a ich użyte znaki zamieniłem na svg i umieściłem w miejscach gdzie
          występowały ikony wyświetlane z plików czcionek.
    -   Postanowiłem, że za pomocą gulpa najważniejsze zasoby zostaną dodane do pliku `index.html` w formie tekstowej. Są to:
        - Krytyczne dla pierwszego renderu style strony, które przy pomocy `gulp-inject`
          zostały dodane do pliku `index.html` w tagu `<head>`.
        - Wszystkie skrypty, które uprzednio przy pomocy `gulp'a` ze sobą scalone,
          zminifikowane i dodane do pliku `index.html` na końcu tagu `<body>`.
        - Jako że style skryptów takich jak `swiper`, `glightbox` są niezbędne do poprawnego działania strony,
          ale nie są krytyczne dla pierwszego renderu, to zostały scalone, zminifikowane i umieszczone na stronie
          klasycznie, przy pomocy tagu `<link>` w `<head>`.
          (W czasie testów tak wychodziło korzystniej zamiast je umieszczać bezpośrednio w pliku `index.html`
          tak jak zostały umieszczone główne style).
6. Aby powyższe zmiany zostały zastosowane na stronie to musiałem uruchomić komendę `npm run build`,
   która de facto uruchamia gulp'a.