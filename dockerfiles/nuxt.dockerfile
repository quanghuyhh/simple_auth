FROM node:16.17

# create destination directory
RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

COPY ./frontend/package.json /usr/src/app/package.json
RUN yarn install
RUN ls -la
RUN ls -la node_modules

# copy the app, note .dockerignore
COPY ./frontend /usr/src/app/
RUN ls -la

# build necessary, even if no static files are needed,
# since it builds the server as well
RUN yarn build

# expose 5000 on container
EXPOSE 5000

# set app serving to permissive / assigned
ENV NUXT_HOST=0.0.0.0
# set app port
ENV NUXT_PORT=5000

# start the app
CMD [ "npm", "run", "start" ]