package com.mmdiyul.monitoringsuhu.model;

public class Sensor {
    private int id;
    private int ketinggian;
    private float kekeruhan;
    private float pH;
    private String update;

    public Sensor(int ketinggian, float kekeruhan, float pH, String update) {
//        this.id = id;
        this.ketinggian = ketinggian;
        this.kekeruhan = kekeruhan;
        this.pH = pH;
        this.update = update;
    }

//    public int getId() {
//        return id;
//    }

    public int getKetinggian() {
        return ketinggian;
    }

    public float getKekeruhan() {
        return kekeruhan;
    }

    public float getpH() {
        return pH;
    }

    public String getUpdate() {
        return update;
    }
}
