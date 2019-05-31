package br.gov.inep;

import com.google.common.base.Strings;
import com.google.common.collect.ImmutableMap;
import com.sun.org.apache.xpath.internal.operations.Bool;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.AbstractMap;
import java.util.Arrays;
import java.util.Map;
import java.util.Set;
import java.util.concurrent.atomic.LongAdder;
import java.util.stream.Collectors;
import java.util.stream.Stream;

public class Carentes {

	public static void main(String[] args) {
		try (
				Stream<String> carentes = Files.lines(Paths.get("/Users/fabianomaeda/carentes_bolonhas.csv"));
				Stream<String> ausentes = Files.lines(Paths.get("/Users/fabianomaeda/carentes_ausentes.csv"));
				Stream<String> carentesOracle = Files.lines(Paths.get("/Users/fabianomaeda/carentes_oracle.csv"))
		) {

			Set<String> CACHE_AUSENTES = ausentes.collect(Collectors.toSet());
			Set<String> CACHE_ORACLE = carentesOracle.collect(Collectors.toSet());

			Map<String, LongAdder> CONTADOR = ImmutableMap.of(
					"Lei", new LongAdder(),
					"Decreto", new LongAdder(),
					"Ambos", new LongAdder(),
					"Erro", new LongAdder()
			);

			Map<String, LongAdder> CONTADOR_AUSENTES = ImmutableMap.of(
					"Lei", new LongAdder(),
					"Decreto", new LongAdder(),
					"Ambos", new LongAdder(),
					"Erro", new LongAdder()
			);

			LongAdder TOTAL_MONGO = new LongAdder();

			carentes.forEach(line -> {
				if (line.startsWith("\"_id\"")) {
					return;
				}

				String[] values = line.split(",");
				String coInscricao = values[0];
				boolean lei = Boolean.parseBoolean(values[1]);
				boolean decreto = Boolean.parseBoolean(values[2]);
				String tipoCarencia = values.length > 3 ? values[3] : "";

				if (!CACHE_ORACLE.contains(coInscricao)) {
					System.out.println("Inscricao nao consta no Oracle: " + coInscricao);
					return;
				} else {
					CACHE_ORACLE.remove(coInscricao);
				}

				TOTAL_MONGO.increment();


				if (Strings.isNullOrEmpty(tipoCarencia)) {
					if (lei && decreto) {
						tipoCarencia = "Ambos";
					} else if (lei) {
						tipoCarencia = "Lei";
					} else if (decreto) {
						tipoCarencia = "Decreto";
					} else {
						tipoCarencia = "Erro";
					}
				} else {
					if (tipoCarencia.equals("1")) {
						tipoCarencia = "Lei";
					} else {
						tipoCarencia = "Decreto";
					}
				}

				CONTADOR.get(tipoCarencia).increment();
				if (CACHE_AUSENTES.contains(coInscricao)) {
					CONTADOR_AUSENTES.get(tipoCarencia).increment();
				}
			});

			System.out.println("TOTAL");
			CONTADOR.entrySet().stream().forEach(i -> System.out.println(i.getKey() + ": " + i.getValue()));
			System.out.println("Carentes MONGO: " + TOTAL_MONGO.intValue());
			System.out.println("Carentes ORACLE: " + (CACHE_ORACLE.size() - 1));
			System.out.println();

			System.out.println("AUSENTES");
			CONTADOR_AUSENTES.entrySet().stream().forEach(i -> System.out.println(i.getKey() + ": " + i.getValue()));

			System.out.println();
			System.out.println("RESTO DO ORACLE");
			CACHE_ORACLE.forEach(System.out::println);

		} catch (IOException e) {
			e.printStackTrace();
		}
	}


}
