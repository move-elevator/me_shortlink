Installationshinweise:
- den Ordner Setup/me_download/ in den Ordner fileadmin/xxx-extensions/ verschieben
- die setup.t3s / constants.t3s im gewünschten Template einbinden.
- Template-Pfade in der constants.t3s anpassen

Konfigurationshinweise:
- zur Installation der me_download können folgende Features aktiviert / deaktiviert werden:
    * Kategorisierung
    * Aktivierung Post-Bestellung
    * Standardwert für Post-Bestellung
    * Download-Bild Fallback
    * Kategorie-Bild Fallback

Hook:
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] = "MoveElevator\MeShortlink\Controller\ShortlinkController->redirectAction";
