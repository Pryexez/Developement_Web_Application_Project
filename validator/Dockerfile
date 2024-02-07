FROM openjdk:13-alpine

WORKDIR /src/
RUN apk add --no-cache \
	npm \
	python3-dev \
	py3-pip
	
RUN npm install --save vnu-jar

COPY ./requirements.txt .
RUN pip3 install --no-cache-dir -r requirements.txt

COPY ./main.py .

ENTRYPOINT ["java", "-jar", "node_modules/vnu-jar/build/dist/vnu.jar"]
CMD ["--help"]
