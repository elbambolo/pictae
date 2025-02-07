**ATTENZIONE: Progetto in Fase di Sviluppo**

Questo progetto è attualmente in fase di sviluppo e non è ancora completamente funzionante. Il codice è incompleto e potrebbe contenere bug. Una versione funzionante sarà disponibile a breve. Resta sintonizzato per gli aggiornamenti!


# Galleria Immagini Multimediali

Questo progetto è una piattaforma per la gestione di gallerie di immagini multimediali basata su PHP, MySQL e CodeIgniter. Include funzionalità per la conversione automatica di immagini in formati come AVIF.

## Prerequisiti

- PHP 8.1 o superiore
- MySQL 5.7 o superiore
- Composer
- CodeIgniter 4.x

## Installazione

1. Clona questo repository:
    ```bash
    git clone https://github.com/elbambolo/pictae.git
    ```
2. Spostati nella directory del progetto:
    ```bash
    cd galleria-immagini
    ```
3. Installa le dipendenze con Composer:
    ```bash
    composer install
    ```
4. Configura il database:
    - Crea un database MySQL.
    - Modifica il file `.env` con le tue credenziali del database.
5. Esegui le migrazioni per creare le tabelle necessarie:
    ```bash
    php spark migrate
    ```
6. Avvia il server:
    ```bash
    php spark serve
    ```

## Utilizzo

### Caricamento Immagini

1. Accedi alla piattaforma.
2. Naviga alla sezione "Carica Immagini".
3. Seleziona le immagini da caricare e scegli i formati di conversione desiderati (es. AVIF).

### Gestione Gallerie

- Crea, modifica e cancella gallerie di immagini.
- Visualizza le immagini caricate nelle gallerie.

## Conversione Immagini

Le immagini caricate verranno automaticamente convertite nei formati selezionati utilizzando librerie come Imagick.

## Struttura del Progetto

- `app/Controllers` - Contiene i controller del progetto.
- `app/Models` - Contiene i modelli del progetto.
- `app/Views` - Contiene le viste del progetto.
- `public/` - Directory pubblica per le risorse statiche.
- `writable/` - Directory per file temporanei e cache.

## Contributi

Siamo felici di ricevere contributi! Sentiti libero di aprire una pull request o segnalare problemi.

## Licenza

Questo progetto è distribuito sotto la licenza. Vedi il file `LICENSE` per maggiori dettagli.
