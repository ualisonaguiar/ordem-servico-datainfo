package br.gov.inep;

import java.io.IOException;
import java.io.PrintWriter;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.stream.Stream;

public class GerarUpdateCarencia {

	private final static String UPDATE = "update enem.tb_inscricao set ";

	public static void main(String[] args) {

		try (
			Stream<String> lines = Files.lines(Paths.get("/Users/fabianomaeda/carentes_mongo.csv"));
			PrintWriter writer = new PrintWriter("/Users/fabianomaeda/carentes_update_oracle.csv")
		) {

//			lines.forEach();


		} catch (IOException e) {
			e.printStackTrace();
		}


	}

}
