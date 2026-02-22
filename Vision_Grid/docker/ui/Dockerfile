FROM node:20-alpine

WORKDIR /app

# Копируем package.json и package-lock.json (для кеширования слоёв)
COPY package*.json ./
RUN npm install

# Копируем весь фронт
COPY . .

EXPOSE 5173

CMD ["npm", "run", "dev", "--", "--host"]
