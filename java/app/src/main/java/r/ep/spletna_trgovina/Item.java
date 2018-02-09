package r.ep.spletna_trgovina;

/**
 * Created by Simona on 20. 01. 2018.
 */
import java.io.Serializable;
import java.util.Locale;

public class Item implements Serializable {
    public int id;
    public String name, uri, description;
    public double price;

    @Override
    public String toString() {
        return String.format(Locale.ENGLISH,
                "%s (%.2f EUR)",
                name, price);
    }
}
