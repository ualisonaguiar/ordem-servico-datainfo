package br.gov.inep;

import io.vertx.core.AbstractVerticle;
import io.vertx.core.DeploymentOptions;

public class Main extends AbstractVerticle {

  @Override
  public void start() throws Exception {
    vertx.deployVerticle(ApexVerticle.class.getName(), new DeploymentOptions().setConfig(config()).setWorker(true).setInstances(4));
    vertx.deployVerticle(RestVerticle.class.getName(), new DeploymentOptions().setConfig(config()));
  }

}
