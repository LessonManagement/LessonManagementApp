FROM node

# Creamos estructura de carpetas de nuestra app node
RUN mkdir -p /home/node/app/node_modules \
&& chown -R node:node /home/node/app

# Directorio de trabajo de la aplicacion para
# hacer las copias sin rutas
WORKDIR /home/node/app

# Copiar paquetes que necesitamos
COPY package*.json ./

# Usuario que ejecuta el contenedor
USER node

# Instalar dependencias
RUN npm install

# Copiar la app al contenedor
COPY --chown=node:node . .

#Puerto por defecto
EXPOSE 443

# Llamamos al programa principal
CMD [ "node", "app.js" ]
