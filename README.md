# Bookkinder Backend

## Docker Compose

Para levantar el proyecto con Docker Compose:

```bash
docker-compose up -d
```

El backend estará disponible en: `http://localhost:80`

## Configuración de Host Virtual

Para acceder a la API desde `http://api.bookkinder.test`, necesitas configurar un host virtual:

### Windows

1. Abrir el archivo `hosts` como administrador:
   - Presiona `Windows + R`
   - Escribe: `notepad C:\Windows\System32\drivers\etc\hosts`
   - Presiona `Ctrl + Shift + Enter` para ejecutar como administrador

2. Agregar la siguiente línea al final del archivo:
   ```
   127.0.0.1 api.bookkinder.test
   ```

3. Guardar el archivo y cerrar el editor

### Mac

1. Abrir terminal y ejecutar:
   ```bash
   sudo nano /etc/hosts
   ```

2. Agregar la siguiente línea al final del archivo:
   ```
   127.0.0.1 api.bookkinder.test
   ```

3. Guardar con `Ctrl + X`, luego `Y`, luego `Enter`

Después de configurar el host virtual, podrás acceder a la API en: `http://api.bookkinder.test`
