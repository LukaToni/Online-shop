package r.ep.spletna_trgovina;

/**
 * Created by Simona on 20. 01. 2018.
 */

import java.util.List;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

public class ItemService {
    interface RestApi {
        String URL = "http://10.0.2.2:8080/netbeans/spl_trgovina/api/";

        @GET("articles")
        Call<List<Item>> getAll();

        @GET("articles/{id}")
        Call<Item> get(@Path("id") int id);

        @FormUrlEncoded
        @POST("articles")
        Call<Void> insert(@Field("name") String title,
                          @Field("price") double price,
                          @Field("description") String description);

        @FormUrlEncoded
        @PUT("articles/{id}")
        Call<Void> update(@Path("id") int id,
                          @Field("name") String title,
                          @Field("price") double price,
                          @Field("description") String description);
    }

    private static RestApi instance;

    public static synchronized RestApi getInstance() {
        if (instance == null) {
            final Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(RestApi.URL)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();

            instance = retrofit.create(RestApi.class);
        }

        return instance;
    }
}
