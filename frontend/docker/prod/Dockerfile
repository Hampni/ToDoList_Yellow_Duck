FROM node:16-alpine as builder
WORKDIR /app
COPY package*.json /app/
RUN npm install
COPY . .
RUN npm run build

FROM nginx
EXPOSE 3000
COPY docker/prod/default.conf /etc/nginx/conf.d/default.conf
COPY --from=builder /app/dist /usr/share/nginx/html