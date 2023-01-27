import pandas as pd
import csv
import sys
import scipy
from scipy.sparse import csr_matrix
import math
import json

def algoritmo(): 
    ser_ps_u = float(sys.argv[1])
    ratings_u =[int(sys.argv[2]), int(sys.argv[3]), int(sys.argv[4]), int(sys.argv[5]), int(sys.argv[6])]

    df_ratings = pd.read_csv(r'/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/new_ratings_1000.csv')
    df_personalityData = pd.read_csv(r'/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/new_personalityData_1000.csv')
    
    list_ids = list(df_personalityData['user_id'].unique())
    list_repeated_ids = list(df_ratings['user_id'])
    new_id = []
    for i in list_repeated_ids:
        new_id.append(list_ids.index(i))
    df_ratings = df_ratings.assign(new_id=pd.Series(new_id).values)

    df_movies = pd.read_csv(r'/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/new_movies_1000.csv')
    df_ratings_base = pd.read_csv(r'/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/cleaned_ratings.csv')

    with open('/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/filtered_dict_pop.csv') as dict_pop_file:
        reader = csv.reader(dict_pop_file)
        next(reader)
        dict_pop = dict(reader)
    dict_pop = dict((int(k),float(v)) for k,v in dict_pop.items())

    df_ratings_base = df_ratings_base[df_ratings_base['movie_id'].isin(df_ratings['movie_id'].unique())]
    new_df=pd.concat([df_ratings,df_ratings_base]).drop_duplicates(keep=False)

    user_ratings = {}
    ids = [60, 261, 277, 2641, 56176, 84716]
    for i in range(5):
        user_ratings[ids[i]]= ratings_u[i]

    count = 0
    for i in user_ratings.values():
        count = count + i
    mean_rA = count/len(user_ratings) 

    dict_intersection_movies = {}
    dict_user_profiles = {}

    for user in df_ratings['new_id'].unique():
        user_profile = df_ratings.loc[(df_ratings['new_id']==user)]['movie_id'].tolist()
        dict_user_profiles[user] = user_profile 
    for user in dict_user_profiles.keys():
        intersection_set = set.intersection(set(dict_user_profiles[user]), set(list(user_ratings.keys())))
        if len(intersection_set):
            dict_intersection_movies[user] = list(intersection_set)

    rating_matrix = csr_matrix((df_ratings['rating'], (df_ratings['new_id'], df_ratings['movie_id'])))    
    dict_mean_r = {}
    for user in dict_intersection_movies.keys():
        mean = 0
        count = 0
        n = 0
        for index, row in df_ratings.loc[(df_ratings['new_id']==user)].iterrows():
            count = count + row['rating']
            n = n+1
        dict_mean_r[user] = count/n
    dict_sim_neighbors = {}

    # Viene calcolata la similarità tra l’utente target u e ogni utente v che ha con lui almeno un item co-rated, 
        #utilizzando il Pearson Correlation Coefficient.

    for user, movies in dict_intersection_movies.items():
        num = 0
        denA = 0
        denB = 0
        mean_rB = dict_mean_r[user]
        for i in movies:
            rA = user_ratings[i]
            #rB = df_ratings.loc[(df_ratings['new_id']==user) & (df_ratings['movie_id']==i)]['rating'].values[0]
            rB = rating_matrix[user,i]
            num = num + ((rA-mean_rA)*(rB-mean_rB))
            denA = denA + ((rA-mean_rA)*(rA-mean_rA))
            denB = denB + ((rB-mean_rB)*(rB-mean_rB))
        sim = num/(math.sqrt(denA)*math.sqrt(denB))
        dict_sim_neighbors[user]=sim
    unobs_movies = list(set(df_movies['movie_id'].unique())-set(user_ratings.keys()))

    # Vengono aggiunti all’insieme M gli utenti per i quali la similarità risulta maggiore di 0.2, 
    # cioè il valore che è stato ritenuto essere la soglia più adatta oltre la quale considerare 
    # due utenti abbastanza simili, essendo il Pearson Correlation Coefficient compreso tra -1 e +1
    nearest_neighbors = {k: v for k, v in dict_sim_neighbors.items() if v>=0.2}

    #viene poi calcolato il predicted rating rˆu,i dell’utente target u per ogni item i al quale l’utente non ha ancora assegnato un rating;
    dict_pred_r = {}
    for i in unobs_movies:
        num = 0
        den = 0
        for j in nearest_neighbors.keys():
            '''ratings_list = dict_user_ratings[j]
            r_bi=0
            for (movie, rating) in ratings:
                if movie==i:
                    r_bi=rating
                    break'''
            r_bi = rating_matrix[j,i]
            if r_bi:
                num = num + (nearest_neighbors[j]*(r_bi-dict_mean_r[j]))
                den = den + nearest_neighbors[j]
        if den:
            dict_pred_r[i] = mean_rA + (num/den)

    dict_user_ratings = {}

    dict_pred_r = {}
    for i in unobs_movies:
        num = 0
        den = 0
        for j in nearest_neighbors.keys():
            '''ratings_list = dict_user_ratings[j]
            r_bi=0
            for (movie, rating) in ratings:
                if movie==i:
                    r_bi=rating
                    break'''
            r_bi = rating_matrix[j,i]
            if r_bi:
                num = num + (nearest_neighbors[j]*(r_bi-dict_mean_r[j]))
                den = den + nearest_neighbors[j]
        if den:
            dict_pred_r[i] = mean_rA + (num/den)

    #viene successivamente inizializzato l’insieme vuoto C degli item candidati;
    #infine, gli item dell’insieme I con il predicted rating più alto, più precisamente il 10% del totale, 
    # vengono inseriti nell’insieme C, che costituirà il punto di partenza della seconda fase dell’algoritmo.
    n = len(dict_pred_r)
    n_chosen = n//10

    ordered = sorted(dict_pred_r.items(), key=lambda item: item[1], reverse=True)
    _, max_r = ordered[0]
    _, min_r = ordered[-1]

    new_ordered = []
    for movie, rating in ordered:
        r = (rating-min_r)/(max_r-min_r)
        new_ordered.append((movie,r))

    dict_chosen_pred_r = dict(new_ordered[0:n_chosen])

    with open('/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/dict_sim_new.csv') as dict_sim_file:
        reader = csv.reader(dict_sim_file)
        next(reader)
        dict_sim = dict(reader)
    
    def tuple(string):
        ids = string[1:-1].split(", ")
        ids[0]=int(ids[0])
        ids[1]=int(ids[1])
        return (ids[0], ids[1])
    dict_sim = dict((tuple(k),float(v)) for k,v in dict_sim.items())

    rec_list = []
    n_ser = 0
    ser_values={}
    count = 0

    for i in range(5):
        count = count+1
        print(count)
        dict_score_final = {}
        for k, v in dict_chosen_pred_r.items():
            diss_m = 0
            for m in user_ratings.keys():
                if (m,k) in dict_sim.keys():
                    sim = dict_sim[(m,k)]
                elif (k,m) in dict_sim.keys():
                    sim = dict_sim[(k,m)]
                diss_m = diss_m + (1-sim)
            diss_ui = diss_m/len(user_ratings)
            ser_ui = 0.9 * v + 0.7 * diss_ui - 0.6 * dict_pop[k]
            if k not in ser_values:
                ser_values[k]=ser_ui
            if ser_ui > 0.7:
                curr_n_ser=n_ser+1
            else:
                curr_n_ser=n_ser
            ser_list = curr_n_ser/(len(rec_list)+1)
            score_ser = - abs(ser_ps_u-ser_list)
            #score_final = 0.9 * v + 0.1 * score_ser
            score_final = score_ser
            dict_score_final[k]=score_final
        ordered_score = sorted(dict_score_final.items(), key=lambda item: item[1], reverse=True)
        movie, score = ordered_score[0]
        if ser_values[movie]>0.7:
            n_ser=n_ser+1
        rec_list.append(movie)
        dict_chosen_pred_r.pop(movie)

    rec_list = [int(i) for i in rec_list]
    return json.dumps(rec_list)


if __name__ == "__main__":
    print(algoritmo())


